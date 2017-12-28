<?php
set_time_limit(0);

echo ' =========================== <br/>';
echo '    MD5 BRUTE FORCE';
echo '<br/> =========================== <br/><br/>';

echo '<a id="top" href="#bottom">bottom</a>';

echo '<br/><br/> =========================== <br/>CONFIGURATION<br/>  =========================== <br/><br/>';

if (isset($_POST['mdp']) AND !empty($_POST['mdp'])) {
    $mdp = $_POST['mdp'];

$start = microtime(true);
$find = false;
$minlenght = 3;
$maxlenght = 5;
$chaine = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
//$chaine = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789²&é"'(-è_çà)=#{[|^@]}^¨$£¤ù%*µ,?;.:/!§';

$hash = md5($mdp);

$result = 0;

echo 'chaine ('.strlen($chaine).') : '.$chaine.'<br/>';

echo 'hash : '.$hash;

echo '<br/><br/> =========================== <br/>EXECUTION<br/>  =========================== <br/>';


$maxLength = $maxlenght;
$charSet = $chaine;
$size = strlen($charSet);
$base = array();
$counter = 0;
$baseSize = $minlenght;
// Let's see how many combinations exist for the given length and charset
$combinations = 0;
for($i=1;$i<=$maxLength;$i++) {
    $combinations += pow($size,$i);
} 
//$result = $combinations;
while($baseSize <= $maxLength) {
	// Go through all the possible combinations of last character and output $base
    for($i=0;$i<$size;$i++) {
        $base[0] = $i;
        $Char = '';
        for($j=$baseSize-1;$j>=0;$j--) {
            $Char .= $charSet[$base[$j]];
        }
   // echo $Char.'<br/>';	
        if (!$find) {$result++;}
        if (md5($Char) == $hash AND !$find) {echo '<p style="color: green">Find pass :  '.$Char.'</p><br/>'; $find = true;}
    }
	// How many $base elements reached their max?
    for($i=0;$i<$baseSize;$i++) {
        if($base[$i] == $size-1) $counter++;
        else break;
    }
	// Every array element reached max value? Expand array and set values to 0. 
    if($counter == $baseSize) {
		// Notice <=$baseSize! Initialize 0 values to all existing array elements and ADD 1 more element with that value
        for($i=0;$i<=$baseSize;$i++) {
            $base[$i] = 0;
        }
        $baseSize = count($base);
    }
	// Carry one
    else {
        $base[$counter]++;
        for($i=0;$i<$counter;$i++) $base[$i] = 0;
    }
    $counter=0;
}




$end = microtime(true);
$time = $end - $start;

echo '<br/><br/> =========================== <br/>';
echo '<p style="color: red">temps d\'exécution : '.$time.' secondes</p>';
echo '<p style="color: green">result: '.$result.'</p>';
echo ' =========================== <br/>';
echo '<a id="bottom" href="#top">top</a>';
exit();

} else  { ?>
<form action="" method="post">
    <input type="text" name="mdp"/>
    <input type="submit"/>
</form>
<?php } ?>



<?php /*
$charset = range(97, 122); 
function recurse($width, $position, $base) { 
    global $charset; 
    foreach($charset as $char) { 
        if ($position < $width - 1) recurse($width, $position + 1, $base.chr($char)); 
        echo $base.chr($char)."\n"; // ici on fait ce que l'on veut du mot là je l'affiche. 	
    }
} 
$maxChars = 3; 
for($width = 1; $width < $maxChars+1; ++$width) recurse($width, 0, ""); 
*/
?>