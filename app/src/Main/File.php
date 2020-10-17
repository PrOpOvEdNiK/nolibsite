<?php


namespace BS\Main;


use Exception;

class File
{
    public const UPLOAD_DIR = "/upload";

    private $tempFile;
    private $arFile;

    private $uploadPath;

    private function prepareFileArrayForDb(array $arFile): void
    {
        $this->tempFile = $arFile['tmp_name'];
        unset($arFile['tmp_name']);
        unset($arFile['error']);

        $arFile = array_flip($arFile);
        foreach ($arFile as &$v) {
            $v = mb_strtoupper($v);
        }

        $this->arFile = array_flip($arFile);
    }

    private function makePaths(string $subDir): void
    {
        $documentRoot = $_SERVER['DOCUMENT_ROOT'];
        $uploadDir = self::UPLOAD_DIR;
        $groupDir = date('Ymd');
        $uniqueDir = md5(implode('', $this->arFile));

        $publicPath = "{$uploadDir}/{$subDir}/{$groupDir}/{$uniqueDir}";
        $this->arFile['PATH'] = $publicPath;

        $this->uploadPath = "{$documentRoot}{$publicPath}";
        @mkdir($this->uploadPath, 0755, true);
    }

    /**
     * @param array $arFile from Request
     * @param string $model subfolder name
     * @param array $arResize ['w' => 100, 'h' => 100] if both params is set - is exact resize. If only one - is proportional by side.
     * @return int
     * @throws Exception
     */
    public function upload(array $arFile, string $model, array $arResize = []): int
    {
        if ($arFile['error'] > 0) {
            throw new Exception("Ошибка при загрузке файла");
        }

        $this->prepareFileArrayForDb($arFile);
        $this->makePaths($model);

        if (!file_exists($this->tempFile) || !is_file($this->tempFile)) {
            throw new Exception("Отсутствует загруженный файл");
        }

        if ($arResize) {
            // @todo resize
        }

        $fileId = \BS\Models\File::getFirst(
            [
                ['PATH', '=', $this->arFile['PATH']],
                ['NAME', '=', $this->arFile['NAME']],
                ['SIZE', '=', $this->arFile['SIZE']],
            ]
        )['ID'];

        if ($fileId <= 0 &&
            move_uploaded_file($this->tempFile, "{$this->uploadPath}/{$this->arFile['NAME']}")) {
            $fileId = \BS\Models\File::create($this->arFile);

            if ($fileId <= 0) {
                throw new Exception("Ошибка при сохранении файла");
            }
        }

        return $fileId;
    }

    /**
     * @param array $arFile
     * @param string $model
     * @param array $arResize
     * @return int
     * @throws Exception
     * @see \BS\Main\File::upload
     */
    public function uploadImage(array $arFile, string $model, array $arResize = []): int
    {
        if (!in_array($arFile['type'], ['image/jpeg', 'image/png'])) {
            throw new Exception("Изображение должно быть в формате .jpg или .png");
        }
        return $this->upload($arFile, $model, $arResize);
    }

    public function delete(int $id): bool
    {
        $arFile = \BS\Models\File::getById($id);
        $realPath = $_SERVER['DOCUMENT_ROOT'] . "{$arFile['PATH']}";
        unlink("{$realPath}/{$arFile['NAME']}");
        @rmdir("{$realPath}");
        return \BS\Models\File::delete($id);
    }
}
