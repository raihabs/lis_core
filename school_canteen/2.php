
<?php
// This PHP script will only run on post back from submit
if(isset($_POST['submit'])){
    if(!empty($_POST['sports'])){
        // loop to retrieve checked values
        foreach($_POST['sports'] as $selected){
            echo $selected."</br>";
        }
    }
}
?>