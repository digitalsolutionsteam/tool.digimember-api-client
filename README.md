# digimember-api-client
Small library that let's you connect to the DigiMember API on any wordpress blog

# Installation via composer
Add this entry to your composer.json file
```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/digitalsolutionsteam/tool.digimember-api-client"
    }
]
```
then run the command
    
    composer require digitalsolutions/digimember-api-client
    
# Usage
See the file `example/index.php` in this repository for a usage example.

API Results are decoded into classes for ease of use and IDE auto completion.
See files in  `src/Result` for the possible types. All API call methods are type annotated as well.