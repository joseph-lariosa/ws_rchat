<?php 
include('../includes/config.inc.php');
include('../includes/db.php');
$db = new db($dbhost, $dbuser, $dbpass, $dbname);

$getRadio = $db->query('SELECT * FROM su_settings WHERE id = 1')->fetchArray();

?>


<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="cf-tab" data-toggle="pill" href="#cf" role="tab" aria-controls="cf" aria-selected="true">Radio Settings</a>
    </li>
</ul>

<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="cf" role="tabpanel" aria-labelledby="cf-tab">


        <div class="row">
            <div class="col-lg-6">
                <form class="form" method="POST" action="db-commands/set_radio.php">
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" name="api" aria-describedby="api" placeholder="<?php echo $getRadio['api'];?>I" required>
                        <input type="text" class="form-control mb-2" name="radio_url" aria-describedby="radio_url" placeholder="<?php echo $getRadio['radio_url'];?>" required>
                        <button type="submit" name="radio_settings" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">

    </div>
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">

    </div>
</div>


