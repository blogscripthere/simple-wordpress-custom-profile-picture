<?php
    //get user user_picture
    $userPicture = esc_attr( get_option( 'user_picture' ) );
    //get user user name
    $userName = esc_attr( get_option( 'user_name' ) );
    //get user user description
    $userDescription = esc_attr( get_option( 'user_description' ) );
?>
<div style="width:300px;background-color:#0A246A;padding:20px;text-align:center;margin-right:20px;display:inline-block;float:left;">
    <div class="user-details">
        <div style="display:block;width:100%; overflow:hidden; text-align:center;">
            <div id="user-picture-preview" style="background-image: url(<?php echo $userPicture;?>);width:150px; height:150px;overflow:hidden;border-radius:50%;margin:20px auto;background-position:center center;background-repeat:no-repeat;background-size:cover;"></div>
        </div>
        <h1 style="font-size:22px; margin: 0 0 10px;color:#ffffff"><?php echo $userName; ?></h1>
        <h2 style="font-size:12px; margin: 0 0 20px;color:yellow"; ><?php echo $userDescription; ?></h2>
    </div>
</div>';