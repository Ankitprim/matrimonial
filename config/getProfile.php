<?php
include 'database.php';
$obj = new query();

if (!isset($_GET['id'])) {
    echo "Invalid request!";
    exit;
}

$user_id = intval($_GET['id']);

$profile = $obj->getProfile($user_id);

if ($profile) {
    echo "
        <div style='max-width: 400px; margin: 5px auto;  border-radius: 20px; font-family: Arial, sans-serif; color: white; text-align: center;'>
            <img src='uploads/{$profile['image']}' width='120' height='120' style='border-radius: 10%; border: 4px solid white; box-shadow: 0 8px 25px rgba(0,0,0,0.2); margin-bottom: 20px; object-fit: cover;'><br>
            <h3 style='margin: 0 0 25px 0; font-size: 24px; font-weight: 600; text-shadow: 0 2px 4px rgba(0,0,0,0.3);'>{$profile['full_name']}</h3>
            
            <div style='text-align: left; background: rgba(255,255,255,0.1); padding: 20px; border-radius: 15px; backdrop-filter: blur(10px);'>
                <p style='margin: 12px 0; font-size: 14px; display: flex; align-items: center;'>
                    <span style='display: inline-block; width: 120px; font-weight: bold; color: #ffffff;'>Gender:</span> 
                    <span style='color: white;'>{$profile['gender']}</span>
                </p>
                <p style='margin: 12px 0; font-size: 14px; display: flex; align-items: center;'>
                    <span style='display: inline-block; width: 120px; font-weight: bold; color: #ffffff;'>Height:</span> 
                    <span style='color: white;'>{$profile['height']} cm</span>
                </p>
                <p style='margin: 12px 0; font-size: 14px; display: flex; align-items: center;'>
                    <span style='display: inline-block; width: 120px; font-weight: bold; color: #ffffff;'>Religion:</span> 
                    <span style='color: white;'>{$profile['religion']}</span>
                </p>
                <p style='margin: 12px 0; font-size: 14px; display: flex; align-items: center;'>
                    <span style='display: inline-block; width: 120px; font-weight: bold; color: #ffffff;'>Caste:</span> 
                    <span style='color: white;'>{$profile['caste']}</span>
                </p>
                <p style='margin: 12px 0; font-size: 14px; display: flex; align-items: center;'>
                    <span style='display: inline-block; width: 120px; font-weight: bold; color: #ffffff;'>Mother Tongue:</span> 
                    <span style='color: white;'>{$profile['motherTongue']}</span>
                </p>
                <p style='margin: 12px 0; font-size: 14px; display: flex; align-items: center;'>
                    <span style='display: inline-block; width: 120px; font-weight: bold; color: #ffffff;'>Education:</span> 
                    <span style='color: white;'>{$profile['education']}</span>
                </p>
                <p style='margin: 12px 0; font-size: 14px; display: flex; align-items: center;'>
                    <span style='display: inline-block; width: 120px; font-weight: bold; color: #ffffff;'>Profession:</span> 
                    <span style='color: white;'>{$profile['profession']}</span>
                </p>
                <p style='margin: 12px 0; font-size: 14px; display: flex; align-items: center;'>
                    <span style='display: inline-block; width: 120px; font-weight: bold; color: #ffffff;'>Location:</span> 
                    <span style='color: white;'>{$profile['location']}</span>
                </p>
            </div>
            
            <div style='margin-top: 20px; text-align: left; background: rgba(255,255,255,0.1); padding: 20px; border-radius: 15px; backdrop-filter: blur(10px);'>
                <p style='margin: 15px 0; font-size: 14px; line-height: 1.6;'>
                    <span style='font-weight: bold; color: #ffffff; display: block; margin-bottom: 8px;'>About Me:</span> 
                    <span style='color: white;'>{$profile['aboutMe']}</span>
                </p>
                <p style='margin: 15px 0; font-size: 14px; line-height: 1.6;'>
                    <span style='font-weight: bold; color: #ffffff; display: block; margin-bottom: 8px;'>Looking For:</span> 
                    <span style='color: white;'>{$profile['lookingFor']}</span>
                </p>
            </div>
        </div>
    ";
} else {
    echo "Profile not found!";
}
?>