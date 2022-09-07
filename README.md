**Backend Challenge**

-PHP version: 8.1.1
-Configure the /application/config/database.php for your mysql credentials

For PHP > 8 I need to make 2 little changes:

1. \system\core\Output.php:
	```php
	457. //$output = str_replace(array('{elapsed_time}', '{memory_usage}'), array($elapsed, $memory), $output); PHP < 8.0
	458. $output = $output ? str_replace(array('{elapsed_time}', '{memory_usage}'), array($elapsed, $memory), $output): ""; //PHP 8.1
	```
2. \system\libraries\Form_validation.php	
	```php
	1059. : (trim((string) $str) !== ''); //PHP > 8
	1060. //: (trim($str) !== ''); PHP < 8
	```

# END POINTS

* **URL**

  _/user/login_

* **Method:**  

  | `POST` |
  
*  **URL Params**    

   **Required:**
 
   -`password=[string]`
   -`email=[valid_email|exists]`   

* **Data Params**
	
	![image](https://user-images.githubusercontent.com/15652231/188943211-47c47c20-2213-4a2f-abf2-39e9e41457e8.png)	

* **Success Response:**  

  * **Code:** 201 <br />
    **Content:** `{
    			"uid": 103,
    			"message": "Successfully logged in."
		}`
 
* **Error Response:**

  * **Code:** 400 BAD REQUEST <br />
    **Content:** `{
    "errors": {
        "email": "The Email field must contain a unique value."
    }
}`

  OR

  * **Code:** 401 Unauthorized <br />
    **Content:** `{
    "errors": {
        "password": "The password for the user is invalid."
    }
}`


