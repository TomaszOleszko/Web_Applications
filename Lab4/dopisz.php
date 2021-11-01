<?php
$tech = ["C", "CPP", "Java", "C#", "Html", "CSS", "XML", "PHP", "JavaScript"];
$file_name = "ankieta.txt";

if(!file_exists($file_name)){
    $plik = fopen($file_name,"w+");
    fputs($plik, implode("\n",array_map(function ($v){return $v . ":0";},$tech)));
    fclose($plik);
}
$plik = fopen($file_name,"r+") or exit("Nie da się otworzyć pliku.");

$arg = ['tech' => ['filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    'flags' => FILTER_REQUIRE_ARRAY]];
$dane = (filter_input_array(INPUT_POST,$arg))['tech'];


$tab = [];
while(! feof($plik)){
    $linia = fgets($plik);
    if($linia == ""){
        break;
    }
    $temp = explode(":",$linia);
    $tab[$temp[0]] = $temp[1];
}
fclose($plik);
if(!empty($dane)){
    foreach ($dane as $key1){
        foreach ($tab as $key2 => $key2value){
            if ($key2 == $key1){
                $tab[$key2] += 1;
            }else{
                $tab[$key2] += 0;
            }
        }
    }
}

$string = "";
echo "<h4>";
foreach ($tab as $key => $value){
    echo $key . "- " . $value . "<br>";
    $string .= $key . ":" . $value . "\n";
}
rtrim($string,"\n");
echo "</h4>";
if(!empty($dane)){
    file_put_contents($file_name,$string,LOCK_EX);
}



