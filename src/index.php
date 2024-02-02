<?php
include './fileSystem.php';
print '1............ <br/> Creo el FS ';
$fileSystem = new FileSystem();

print '<br/> ...2........ <br/> ';
$fileSystem->pdw();

print '<br/> ......3...... <br/> ';
$fileSystem->mkdir('proyectos');

print '<br/> ......4...... <br/> ';
$fileSystem->ls();

print '<br/> ......5...... <br/> Hago cambio a proyectos ';
$fileSystem->cd('proyectos');

print '<br/> ......6...... <br/> ';
$fileSystem->pdw();

print '<br/> ......7...... <br/> ';
$fileSystem->touch('proyecto.php');

print '<br/> .....8....... <br/> ';
$fileSystem->mkdir('zerf');

print '<br/> .......9..... <br/> ';
$fileSystem->ls_r();
print ' <br/> ';
$fileSystem->ls();

print '<br/> ......10...... <br/> Voy para atras .. <br/>';
$fileSystem->cd('..');

print '<br/> ....11........ <br/> ';
$fileSystem->pdw();

print '<br/> ......12...... <br/> ';
$fileSystem->ls_r();
print ' <br/> ';
$fileSystem->ls();
print '<br/> ......13...... <br/> ';

