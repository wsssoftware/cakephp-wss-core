<?php
declare(strict_types = 1);

namespace Toolkit\Validation;


use Cake\I18n\Number;
use Intervention\Image\Exception\NotReadableException;
use Intervention\Image\ImageManagerStatic;
use Laminas\Diactoros\UploadedFile;

class WSSValidationUpload
{


    /**
     * Check if is valid mime type
     *
     * @param \Laminas\Diactoros\UploadedFile|mixed $check
     * @param array $mimeTypes
     * @return boolean
     */
    public function isValidMimeType(UploadedFile $check, array $mimeTypes)
    {
        if (in_array($check->getClientMediaType(), $mimeTypes)) {
            return true;
        }
        return false;
    }


    /**
     * Check if is valid file under server configuration
     *
     * @param \Laminas\Diactoros\UploadedFile|mixed $check
     * @return boolean
     */
    public function isValidFileUnderServerConfiguration(UploadedFile $check)
    {
        switch ($check->getError()) {
            case UPLOAD_ERR_INI_SIZE:
                return __('O arquivo enviado excede a diretiva "upload_max_filesize" em php.ini');
            case UPLOAD_ERR_FORM_SIZE:
                return __('O arquivo enviado excede a diretiva MAX_FILE_SIZE que foi especificada no formulário HTML');
            case UPLOAD_ERR_PARTIAL:
                return __('O arquivo selecionado foi carregado apenas parcialmente');
            case UPLOAD_ERR_NO_TMP_DIR:
                return __('Faltando uma pasta temporária');
            case UPLOAD_ERR_CANT_WRITE:
                return __('Falha ao gravar arquivo no disco');
            case UPLOAD_ERR_EXTENSION:
                return __('Uma extensão PHP interrompeu o upload do arquivo');
            default:
                return true;
        }
    }


    /**
     * Check if is image size
     *
     * @param \Laminas\Diactoros\UploadedFile|mixed $check
     * @param int|null $width
     * @param int|null $height
     * @return boolean
     */
    public function isImageSize(UploadedFile $check, ?int $width, ?int $height)
    {
        try {
            $image = ImageManagerStatic::make($check->getStream());
        } catch (NotReadableException $exception) {
            return __('O arquivo não parece ser uma imagem');
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
        $imageWidth = $image->getWidth();
        $imageHeight = $image->getHeight();
        if (!empty($width) && !empty($height) && ($width !== $imageWidth || $height !== $imageHeight)) {
            $size = Number::format($width) . "x" . Number::format($height);
            $imageSize = Number::format($imageWidth) . "x" . Number::format($imageHeight);
            return __('A imagem deve ter "{0}px" porem foi encontrado "{1}px"', $size, $imageSize);
        } elseif (!empty($width)) {
            return __('A imagem deve ter "{1}px" de {0} porem foi encontrado "{2}px"', __('largura'), Number::format($width), Number::format($imageWidth));
        } elseif ((!empty($height))) {
            return __('A imagem deve ter "{1}px" de {0} porem foi encontrado "{2}px"', __('altura'), Number::format($height), Number::format($imageHeight));
        }

        return true;
    }
}