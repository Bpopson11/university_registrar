# _Repeated Word Finder_

#### _Find how many times and where a word is repeated in a sentence/paragraph/string._

#### By _**Brianna Popson**_

## Description

_This app was built with PHP using Silex and Twig templates. The purpose of this app is for a user to enter a string of words be it a paragraph, a singe sentence, or a couple sentences. From there the user can enter the word s/he wishes to see if it is repeated in the string and how many times. The app will return the number of instances of the selected word, as well as reprint the original string with the chosen word appearing in all caps so the user may find it easily._

## Setup/Installation Requirements

* _Fork or clone from GitHub_
* _Please create a separate branch if you cloned_
* _Open the folder in a text editor like Atom to view the code_
* _In your terminal for the site to work, use the command "composer update"_
* _To see the page displayed on the front end, within the terminal navigate to the web folder to initialize a local server_
* _Type in the command "php -S localhost:8000" to start the server_
* _Use localhost:8000 in your web browser to view the page_


## Known Bugs

_As of 2/19/16 the stringHighlight method does not work properly on single letter words such as "a", or "I". Instead the method will make every instance of that letter capital. The instance count for those words is correct though._

## Technologies Used

_This app was built in PHP using HTML alongside Silex and Twig._

### License

*MIT License*

Copyright (c) 2016 **_Brianna Popson_**
