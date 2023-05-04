# around-the-world
This repository is created to submit my solution for the challenge by **_Jazari Robot_**. This challenge is made to test my skills if they fit the position of **_Junior Programmer_**. With that, I am **Aisyah Raihana**, an applicant for the position of Junior Programmer, submit my code for the challenge here.


This project should display a _table of countries_ with its _common name, region, flag_ and _capital_ that are listed in public data from https://restcountries.com/. The list is paginated in which you could choose to display how much entries per page. You could also search for a specific country in the search bar provided at the top of the table. 

According to the challenge given, here is the list of features successfully built.

	> Fetching data
	> Table
	> Sorting
	> Images/HTML
	> Filtering
	> String highliting

So, if there's any of the above features does not function like it supposed to be, please let me know.

As for _row selection_ and _storage mechanisms_, I figured these two are linked to one another; I had tried to code and execute, it did display the checkboxes for Favorite column and I could select to any of them, however, it disrupted the other output. Hence, I attached the code exclusively from the `index.php` file. Please find process.php to review the code.

Also, the list of countries may need an action from you to select the number of entries, to actually display the list according to the desired amount. You may also need to refresh the page if there's no changes or it appears "No data availabe in table" as it needs time to connect with the public data from https://restcountries.com.

*This project is supposed to run **locally** since it is not being deployed to any hosting. I run this project using XAMPP, so here is full instructions on how to access this project and run it locally in your localhost. 

**INSTRUCTIONS**

The instructions have provided alternatives for different type of operating systems and ways to get the source codes from the GitHub. Please choose ones that work for you.

1.	**STEP 1:** _Install XAMPP_ — Download and install XAMPP from the official website (https://www.apachefriends.org/index.html), download the one according to your operating system; MacOS, Windows, Linux etc. Make sure to install the version of XAMPP that matches requirements needed; PHP, MySQL, Apache, and you may add on any that you desire.
2.	**STEP 2:** Get the repository into your local workspace, there are two (2) suggested ways to do it.
	
	i.	_Clone the repository_ — Go to the GitHub repository where the source codes of the project are located and clone the repository to your local machine using Git. You can use the following command in your terminal:
			
			```
		  	git clone <https://github.com/lilytulips/around-the-world.git> 	
			
			```
			
	ii.	_Download the project files_ — If you don't want to use Git to clone the repository, you can download the project files as a ZIP archive from the GitHub repository. To do this, go to the repository page on GitHub, click on the "Code" button, and select "Download ZIP".	
	
	**Note:** The files that you should have are `index.php`, `map.jpg` and `style.css`.
3.	**STEP 3:** _Move the project files_ — Once you have cloned or downloaded the repository, move the project files to the `htdocs` folder of XAMPP, make sure that all the files placed into a folder with name of `countries`.

	i.	If you **cloned** it, the folder is typically located in the `C:\xampp` directory on Windows and `/Applications/XAMPP/htdocs` directory on Mac.

	ii.	If you **downloaded** it, find the folder in your `Download`. Once you have downloaded the ZIP archive, extract its contents to the `htdocs` folder of XAMPP. This folder is typically located in the` C:\xampp` directory on Windows.
4.	**STEP 4:** _Start XAMPP_ — Start the XAMPP control panel and start the Apache and MySQL services.
5.	**STEP 5:** _Run the project_ — Open your web browser and go to `http://localhost/countries` to run the project. 

Usually after STEP 3, at STEP 4 onwards, we created and established connection with a database at phpMyAdmin, however, since the data used in this project is public data from https://restcountries.com.

That's it! You should now be able to run the project locally using XAMPP.

If there is any problem or error encountered during the setup or when the project is running, feel free to reach me at raihanaisyah11@gmail.com or +6011-11106044, I would be happy to assist.

Thank you and hope to hear from you soon!
-**Aisyah Raihana**
