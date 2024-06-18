Internship Problem: PHP Software Development

About:
A web-based application that manages products, counterparties, and sales. 

Technologies Used:
1.	Front-End Development:
•	HTML
•	CSS
•	Javascript
•	BootStrap
2.	Back-End Development:
•	Laravel (incl. Migrations & Eloquent)
•	PHP
3.	Database:
•	MySql

Method Documentation:

CounterpartyController, ProductController, SaleController:

store() 
-	Validates data for:
  o	 counterparty (required attributes, unique bulstat, valid email)
 	
  o	Product (required attribute, valid input of price)
  o	Sale (existing product & counterparty to be added, required attributes)
-	Stores the data (if correct) in database
  
index()
-	Gets all available data that is listed in the tables.
  
destroy()
-	Deletes a selected instance from present counterparties from the database
  
update()
-	Requests input, validates it and updates the present data
  
Home Page:
The following functions allow users to dynamically add data and rows to the “Sales” form.

bindEvents()
-	Initializes autocomplete for product
-	Inputs data for product price based on product input value after autocomplete
-	Handles adding/deleting additional rows to form
  
updateTotal()
-	Dynamically updates the “total” field in the form by calculating product price * amount
  
Products, Counterparties and Sales Pages:
-	Include functionality for adding dynamic content (depending on triggered element) for the edit modal in each page. 

