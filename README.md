**Backend Challenge**
----
 	PHP version: 8.1.1
	
	Configure the /application/config/database.php for your mysql credentials
	![image](https://user-images.githubusercontent.com/15652231/188941088-19791c6f-0575-403c-a684-16b736bd7738.png)
	
	For PHP > 8 I need to make 2 little changes:
	
	1. \system\core\Output.php
	![image](https://user-images.githubusercontent.com/15652231/188941408-fe4d6739-4525-4efd-83e7-b5cb29642839.png)
	
	2. \system\libraries\Form_validation.php	
	![image](https://user-images.githubusercontent.com/15652231/188941925-ef29865a-dff1-474e-b4be-1eca222aebe9.png)
	
----

**END POINTS **

* **URL**

  <_/user/login_>

* **Method:**  

  | `POST` |
  
*  **URL Params**    

   **Required:**
 
   `password=[string]`
	 `email=[valid_email|exists]`   

* **Data Params**
	
	![image](https://user-images.githubusercontent.com/15652231/188943211-47c47c20-2213-4a2f-abf2-39e9e41457e8.png)	

* **Success Response:**
  
  <_What should the status code be on success and is there any returned data? This is useful when people need to to know what their callbacks should expect!_>

  * **Code:** 200 <br />
    **Content:** `{ id : 12 }`
 
* **Error Response:**

  <_Most endpoints will have many ways they can fail. From unauthorized access, to wrongful parameters etc. All of those should be liste d here. It might seem repetitive, but it helps prevent assumptions from being made where they should be._>

  * **Code:** 401 UNAUTHORIZED <br />
    **Content:** `{ error : "Log in" }`

  OR

  * **Code:** 422 UNPROCESSABLE ENTRY <br />
    **Content:** `{ error : "Email Invalid" }`

* **Sample Call:**

  <_Just a sample call to your endpoint in a runnable format ($.ajax call or a curl request) - this makes life easier and more predictable._> 

* **Notes:**

  <_This is where all uncertainties, commentary, discussion etc. can go. I recommend timestamping and identifying oneself when leaving comments here._> 