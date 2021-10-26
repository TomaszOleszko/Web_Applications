<?php
print("FOREACH<br>");
if(!empty($_REQUEST['jezyk']))
{
    echo "Wybrano tutoriale: ";
    foreach ($_REQUEST['jezyk'] as $jezyk)
    {
        echo "$jezyk ";
    }
    echo "<br>";
}

if (isset($_REQUEST['zaplata']))
{
    echo "Sposób zapłaty:".$_REQUEST['zaplata']." <br />";
}
else
{
    echo "Nie wybrano formy zapłaty";
}

print("join<br>");
print("Wybrane tutoriale: ".join(", ",$_REQUEST['jezyk'])."<br>");

print("implode<br>");
print("Wybrane tutoriale: ".implode(", ",$_REQUEST['jezyk']));

foreach($_REQUEST as $key=>$value)
{
    if(is_array($value))
    {
        echo "jezyki: ";
        foreach($value as $value2)
        {
            echo "$value2 ";
        }
        echo "<br>";
    }
    else
    {
        echo "$key = $value <br />";
    }

}

var_dump($_REQUEST);
