<?php

/*
 * created by arcady1254 3.11.2011
 */
header("Content-type: image/jpeg");
$source=$_GET['src']; //��� ��������
$height=$_GET['height']; //�������� ������ ������
$width=$_GET['width']; //�������� ������ ������
$rgb=0xffffff; //���� ������� ��������������
$size = getimagesize($source);//������ ������� �������� (���� ��� ����� size)
$format = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1)); //���������� ��� �����
$icfunc = "imagecreatefrom" . $format;   //����������� ������� �������������� ���� �����
if (!function_exists($icfunc)) return false;  //���� ��� ����� ������� ���������� ������ �������
$x_ratio = $width / $size[0]; //��������� ������ �������� ������
$y_ratio = $height / $size[1]; //��������� ������ �������� ������
$ratio       = min($x_ratio, $y_ratio);
$use_x_ratio = ($x_ratio == $ratio); //����������� ������ � ������
$new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio); //������ ������ 
$new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio); //������ ������
$new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width) / 2); //����������� � ��������� ����������� �� ������
$new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2); //����������� � ��������� ����������� �� ������
$img = imagecreatetruecolor($width,$height); //������� ��������������� ����������� ���������������� ������
imagefill($img, 0, 0, $rgb); //�������� ���
$photo = $icfunc($source); //������� ��� ��������
imagecopyresampled($img, $photo, $new_left, $new_top, 0, 0, $new_width, $new_height, $size[0], $size[1]); //�������� �� ���� ���� ������ � ������ �����������
imagejpeg($img); //������� ��������� (������ ��������)
// ������� ������ ����� ���������� �������
imagedestroy($img);
imagedestroy($photo);
?>
