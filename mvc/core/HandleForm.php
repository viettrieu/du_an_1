<?php

namespace Core;

class HandleForm
{
  /**
   * Validates request data by an array that includes:
   * value, type of validation and custom message for error
   *
   * @param array $validates
   * @return array
   */
  public static function validations(array $validates): array
  {
    $output = [];
    $error = [];
    // $output['status'] = 'OK';
    // $output['message'] = 'Process complete successfully!';

    $defaultMessages = [
      'required' => 'The field should not be empty!',
      'alphabets' => 'The field should be filled by alphabets!',
      'numbers' => 'The field should be filled by numbers!',
      'email' => 'The field should be filled by an email!',
      'date(m/d/y)' => 'The field should be filled by date(m/d/y)!',
      'date(m-d-y)' => 'The field should be filled by date(m-d-y)!',
      'date(d/m/y)' => 'The field should be filled by date(d/m/y)!',
      'date(d.m.y)' => 'The field should be filled by date(d.m.y)!',
      'date(d-m-y)' => 'The field should be filled by date(m-d-y)!',
      'past' => 'The field should be filled by past date!',
      'present' => 'The field should be filled by present date!',
      'future' => 'The field should be filled by future date!',
    ];

    foreach ($validates as $validate) {
      if (!self::validate($validate[0], $validate[1])) {
        $error['status'] = 'ERROR';
        $error['message'] = $validate[2] ?? $defaultMessages[$validate[1]];
        $output[] = $error;
      }
    }

    return $output;
  }

  /**
   * Validation rules
   * More available at https://www.w3resource.com/php/form/php-form-validation.php
   *
   * @param mixed $value
   * @param string $type
   * @return bool
   */
  private static function validate($value, string $type): bool
  {
    $typeValue = explode(':', $type);
    if (count($typeValue) === 2) {
      $type = $typeValue[0];
    }

    switch ($type) {
      case 'required':
        return !empty($value);
      case 'alphabets':
        preg_match('/^[a-zA-Z]*$/', $value, $matches);
        return !empty($value) && !empty($matches[0]);
      case 'numbers':
        preg_match('/^[0-9]*$/', $value, $matches);
        return !empty($value) && !empty($matches[0]);
      case 'email':
        preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $value, $matches);
        return !empty($value) && !empty($matches[0]);
      case 'user':
        preg_match('/^[a-z0-9]{3,10}$/', $value, $matches);
        return !empty($value) && !empty($matches[0]);
      case 'mobile':
        preg_match('/(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})/', $value, $matches);
        return !empty($value) && !empty($matches[0]);
      case 'date(m/d/y)':
        $array = explode("/", $value);
        return !empty($value) && checkdate($array[0], $array[1], $array[2]);
      case 'date(m-d-y)':
        $array = explode("-", $value);
        return !empty($value) && checkdate($array[0], $array[1], $array[2]);
      case 'date(d/m/y)':
        $array = explode("/", $value);
        return !empty($value) && checkdate($array[1], $array[0], $array[2]);
      case 'date(d.m.y)':
        $array = explode(".", $value);
        return !empty($value) && checkdate($array[1], $array[0], $array[2]);
      case 'date(d-m-y)':
        $array = explode("-", $value);
        return !empty($value) && checkdate($array[1], $array[0], $array[2]);
      case 'past':
        return !empty($value) && strtotime($value) < strtotime('now');
      case 'present':
        return !empty($value) && strtotime($value) === strtotime('now');
      case 'future':
        return !empty($value) && strtotime($value) > strtotime('now');
      case 'min':
        return strlen($value) >= intval($typeValue[1]);
      case 'max':
        return strlen($value) <= intval($typeValue[1]);
      case 'Nmin':
        return empty($value) || empty($typeValue[1]) || $value > $typeValue[1];
      case 'Nmax':
        return empty($value) || empty($typeValue[1]) || $value < $typeValue[1];
      case 'confirmed':
        return $value == $typeValue[1];
      default:
        return false;
    }
  }
  /**
   * Upload file
   *
   * @param array $file ($_FILES['name'])
   * @param array $extensions (like ['jpeg', 'jpg','png'] or ['pdf', 'xml', 'csv'])
   * @param integer $size (size in byte)
   * @param string $target (new file address)
   * @param integer $compressRate (like 85)
   * @param string $baseName (like post slug)
   * @param integer $newWidth (new pixel size for width like 1600, height calculate proportionally)
   * @param string $overlay (overlay PNG image address)
   * @param integer $overlayWidth (overlay PNG image width)
   * @param integer $overlayHeight (overlay PNG image height)
   * @return array (2 elements: false and error message OR true and file address)
   */
  public static function upload(
    array $file,
    array $extensions,
    int $size,
    string $target,
    int $compressRate = 100,
    string $baseName = '',
    int $newWidth = 0,
    string $overlay = '',
    int $overlayWidth = 0,
    int $overlayHeight = 0
  ): array {
    if (!(isset($file) && !empty($file['name']))) {
      return [true, NULL];
    }
    if (!isset($file['type'])) {
      return [false, 'File does not exist!'];
    }
    $temporary = explode('.', $file['name']);
    $fileExtension = end($temporary);
    if (!in_array($fileExtension, $extensions)) {
      return [false, 'Định dạng file không được cho phép'];
    }

    if ($file['size'] > $size) {
      return [false, 'Dung lượng file quá lớn!'];
    }

    if ($file['error'] > 0) {
      return [false, 'File error!'];
    }
    $baseName = isset($baseName) ?  $temporary[0] : $baseName;
    $sourcePath = $file['tmp_name'];
    if ($newWidth !== 0) {
      list($width, $height) = getimagesize($file['tmp_name']);
      $ratio = $height / $width;
      $newHeight = $newWidth * $ratio;

      $target1 = $target . $baseName . '-temp.' . $fileExtension;
      move_uploaded_file($sourcePath, $target1);

      $newImage = imagecreatetruecolor($newWidth, $newHeight);
      if ($fileExtension == 'png') {
        $oldImage = imagecreatefrompng($target1);
      } elseif ($fileExtension == 'jpeg') {
        $oldImage = imagecreatefromjpeg($target1);
      } elseif ($fileExtension == 'gif') {
        $oldImage = imagecreatefromgif($target1);
      } elseif ($fileExtension == 'bmp') {
        $oldImage = imagecreatefrombmp($target1);
      } elseif ($fileExtension == 'tga') {
        $oldImage = imagecreatefromtga($target1);
      } elseif ($fileExtension == 'webp') {
        $oldImage = imagecreatefromwebp($target1);
      }
      imagecopyresampled($newImage, $oldImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

      $target2 = $target1 . $baseName . '.' . $fileExtension;
      imagejpeg($newImage, $target2, 100);
      $overlayImage = imagecreatefrompng($overlay);
      imagecopyresampled($newImage, $overlayImage, 0, 0, 0, 0, $overlayWidth, $overlayHeight, $overlayWidth, $overlayHeight);
      imagejpeg($newImage, $target2, $compressRate);

      unlink($target1);
    } else {
      $target1 = $target . $baseName . '.jpg';
      move_uploaded_file($sourcePath, $target1);
    }

    return [true, $target1];
  }
  public static function rip_tags($string)
  {

    // ----- remove HTML TAGs -----
    $string = preg_replace('/<[^>]*>/', ' ', $string);

    // ----- remove control characters -----
    $string = str_replace("\r", '', $string);    // --- replace with empty space
    $string = str_replace("\n", ' ', $string);   // --- replace with space
    $string = str_replace("\t", ' ', $string);   // --- replace with space

    // ----- remove multiple spaces -----
    $string = trim(preg_replace('/ {2,}/', ' ', $string));

    return $string;
  }
}