<?php
include './fileSystem.php';
$fileSystem = new FileSystem();

$fileSystem->pdw();
print '....';
$fileSystem->touch('proyecto.php');
print '   ';
$fileSystem->mkdir('proyectos');
print '   ';
$fileSystem->ls();
print '   ';
$fileSystem->cd('proyectos');
print '   ';
$fileSystem->pdw();
print '   ';
$fileSystem->cd('..');
print '   ';
$fileSystem->pdw();

