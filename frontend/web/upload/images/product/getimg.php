<?php 
for ($i = 0; $i < 100; $i++) {
	$img = file_get_contents('https://picsum.photos/600?random=1');
	file_put_contents(__DIR__."/test{$i}.jpg", $img);
}