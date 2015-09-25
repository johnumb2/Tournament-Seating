<?php

class SecurityController extends Controller 
{
    
    function logout(){
        $_SESSION['name'] = '';
        $_SESSION['email'] = '';
        $_SESSION['loggedIn'] = false;
        $_SESSION['userType'] = '';
        $_SESSION['id'] = 0;
        $_SESSION['accountId'] = 0;

        header('Location: /security/login');
    }
    
    function login(){
                $this->set('title', 'Please Login');
        $this->set('error','');
        $this->set('email', '');
        if(isset($_POST['login'])){
            $this->set('email', $_POST['email']);
            $query = "
                SELECT *
                FROM users
                WHERE email = ?
            ";
            $user = $this->Security->getArray('query', [$query, 's', [$_POST['email']]]);
            $user = $user[0];
            if(!empty($user)){
                $password = $this->decrypt($user['password'], $user['salt']);
                echo $password;
                if($password === $_POST['password']){
                    $_SESSION['name'] = $user['firstName'].' '.$user['lastName'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['userType'] = $user['userType'];
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['accountId'] = $user['accountId'];
        
                    header('Location: /');
                    exit();
                } else {
                    $this->set('error', 'Invalid username or password!');
                }
            } else {
                $this->set('error', 'Invalid username or password!');
            }
            
        }
    }
    /**
     * 
     * @return string
     */
    function securityCheck(){
        if(!isset($_SESSION['loggedIn'])){
            $_SESSION['name'] = '';
            $_SESSION['email'] = '';
            $_SESSION['loggedIn'] = false;
            $_SESSION['userType'] = '';
            $_SESSION['id'] = 0;
            $_SESSION['accountId'] = 0;
        }
        return $_SESSION['loggedIn'];
    }
    
    /**
     * @param $decrypted
     * @param $password
     * @param string $salt
     * @return bool|string
     */
    function encrypt($decrypted, $password, $salt='!kQm*fF3pXe1Kbm%9') {
        // Build a 256-bit $key which is a SHA256 hash of $salt and $password.
        $key = hash('SHA256', $salt . $password, true);
        // Build $iv and $iv_base64.  We use a block size of 128 bits (AES compliant) and CBC mode.  (Note: ECB mode is inadequate as IV is not used.)
        srand(); $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC), MCRYPT_RAND);
        if (strlen($iv_base64 = rtrim(base64_encode($iv), '=')) != 22) return false;
        // Encrypt $decrypted and an MD5 of $decrypted using $key.  MD5 is fine to use here because it's just to verify successful decryption.
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $decrypted . md5($decrypted), MCRYPT_MODE_CBC, $iv));
        // We're done!
        return $iv_base64 . $encrypted;
    }

    /**
     * @param $encrypted
     * @param $password
     * @param string $salt
     * @return bool|string
     */
    function decrypt($encrypted, $password, $salt='!kQm*fF3pXe1Kbm%9') {
        // Build a 256-bit $key which is a SHA256 hash of $salt and $password.
        $key = hash('SHA256', $salt . $password, true);
        // Retrieve $iv which is the first 22 characters plus ==, base64_decoded.
        $iv = base64_decode(substr($encrypted, 0, 22) . '==');
        // Remove $iv from $encrypted.
        $encrypted = substr($encrypted, 22);
        // Decrypt the data.  rtrim won't corrupt the data because the last 32 characters are the md5 hash; thus any \0 character has to be padding.
        $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, base64_decode($encrypted), MCRYPT_MODE_CBC, $iv), "\0\4");
        // Retrieve $hash which is the last 32 characters of $decrypted.
        $hash = substr($decrypted, -32);
        // Remove the last 32 characters from $decrypted.
        $decrypted = substr($decrypted, 0, -32);
        // Integrity check.  If this fails, either the data is corrupted, or the password/salt was incorrect.
        if (md5($decrypted) != $hash) return false;
        // Yay!
        return $decrypted;
    }

    /*************************************************************
     *
     * JAU random creates the random half of the password that
     * is stored in the database
     *
     *************************************************************/
    function random($length = 8)
    {
        $chars = 'bcdfghjklmnprstvwxzaeiou0123456789';
        $result="";
        for ($p = 0; $p < $length; $p++)
        {
            $result .= ($p%2) ? $chars[mt_rand(19, 33)] : $chars[mt_rand(0, 18)];
        }

        return $result;
    }
}