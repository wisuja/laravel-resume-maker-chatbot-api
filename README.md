# Resume Maker Chatbot Application API

This is a project that I did when I was in my college studies. It is a resume maker application that was built using CI4 and Laravel. This project utilizes [Careerjet Public API](https://www.careerjet.com/partners/api/) to search for jobs.

## Steps to run this application:

1. Click on `<> Code` button
2. Copy the HTTPS/SSH repository link
3. Run `git clone` command on your terminal.
4. Run `composer install`
5. Copy the .env file `cp .env.example .env`
6. Change the database data
7. Run `php artisan key:generate` to generate APPKEY
8. Run `php artisan jwt:secret` to generate JWT Secret
9. Run `php artisan migrate && php artisan db:seed`
10. Put Careerjet's AFFID in .env
11. Run `php artisan serve`
12. Access it on `http://localhost:8000`

### Resume Maker Client repository : [Click here](https://github.com/wisuja/ci4-resume-maker)

## API Documentation

### Register an account

```
  POST /register

  Request
  {
      "name" : "user",
      "username" : "user",
      "password" : "123",
      "password_confirmation" : "123",
  }

  Response
  {
      "message": "User has been created successfully.",
      "data": {
        "user": {
          "name": "user",
          "username": "user",
        },
        "token": "somejwttokeninhere"
      }
  }
```

### Log in to an account

```
  POST /login

  Request
  {
      "username" : "user",
      "password" : "123",
  }

  Response
  {
      "message": "User has logged in.",
      "data": {
        "user": {
          "name": "user",
          "username": "user",
        },
        "token": "somejwttokeninhere"
      }
  }
```

### Download CV

```
  GET /cv/{id}
```

> Disclaimer. You need to include Authorization header on each request. `Authorization: 'Bearer putyourjwttokenhere'

### Chat

```
  GET /chat

  Response
  {
    "message": "Hi there! Is there something I can help?",
    "data": {
      "commands": [
        {
          "command": "/createcv",
          "description": "Create a CV."
        },
        {
          "command": "/history",
          "description": "List all created CVs."
        },
        {
          "command": "/help",
          "description": "List all available commands."
        }
      ]
    }
  }
```

#### Normal Chat

```
  POST /chat

  Request
  {
    "username" : "username",
    "message" : "chat",
  }

  Response
  {
    "message": "Hi there! Is there something I can help?",
    "data": {
      "commands": [
        {
          "command": "/createcv",
          "description": "Create a CV."
        },
        {
          "command": "/history",
          "description": "List all created CVs."
        },
        {
          "command": "/help",
          "description": "List all available commands."
        }
      ]
    }
  }
```

#### Help

```
  POST /chat

  Request
  {
    "username" : "username",
    "message" : "/help",
  }

  Response
  {
    "message": "Hi there! Is there something I can help?",
    "data": {
      "commands": [
        {
          "command": "/createcv",
          "description": "Create a CV."
        },
        {
          "command": "/history",
          "description": "List all created CVs."
        },
        {
          "command": "/help",
          "description": "List all available commands."
        }
      ]
    }
  }
```

#### History

```
  POST /chat

  Request
  {
    "username" : "username",
    "message" : "/history",
  }

  Response
  {
    "message": "List all created CVs.",
    "data": {
      "cvs": [
        {
          "url_cv": null,
          "url_recommendation": null,
          "cv_detail": {
            "name": null,
            "email": null,
            "phone": null,
            "address": null,
            "keywords": null,
            "skills": null,
            "description": null,
            "education": null,
            "work_experiences": null,
            "links": null
          }
        },
        ...
      ]
    }
  }
```

#### Create CV

```
  POST /chat

  Request
  {
    "username" : "username",
    "message" : "/createcv",
  }

  Response
  {
    "message": "Please follow this format for making your awesome CV!",
    "data": {
      "createcv": true,
      "parameter": "name"
    }
  }
```

#### Inserting value

```
  POST /chat

  Request
  {
    "username" : "username",
    "message" : "name_value",
    "createcv" : "true",
    "parameter" : "name",
  }

  Response
  {
    "message": "Please follow this format for making your awesome CV!",
    "data": {
      "createcv": true,
      "parameter": "email"
    }
  }
```

### Result

```
  Response
  {
    "message": "Your CV is complete!",
    "data": {
      "createcv": true,
      "jobs_recommendations": [
        {
          "locations": "location",
          "site": "site",
          "date": "date",
          "url": "url",
          "title": "title",
          "description": "description",
          "company": "company",
          "salary": "salary"
        }
      ],
      "url_cv": "http://localhost:8000/cv/1"
    }
  }
```

### Profile

### Show user's profile

```
  GET /profile/{username}

  Response
  {
    "message": "User's data",
    "data": {
      "user": {
        "name": "user",
        "username": "user",
      }
    }
  }
```

### Updating profile

```
  POST /profile/{username}

  Request
  {
    "_method" : "PUT",
    "name" : "name",
    "password" : "password",
    "password_confirmation" : "password",
  }

  Response
  {
    "message": "User's data has been updated successfully",
    "data": {
      "user": {
        "name": "user",
        "username": "user",
      }
    }
  }
```
