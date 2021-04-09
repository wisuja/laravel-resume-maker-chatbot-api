# Resume maker Chatbot Application API

Built using Laravel 8 and Careerjet Public API.

This is the API source code for Resume maker Chatbot Application

## Install steps:

1. Clone this repo `git clone https://github.com/wisuja/Resume-maker-Chatbot-API.git`
2. Run `composer install`
3. Copy the .env file `cp .env.example .env`
4. Change the database name
5. Run `php artisan key:generate` to generate APPKEY
6. Run `php artisan jwt:secret` to generate JWT Secret
7. Run `php artisan migrate && php artisan db:seed`
8. Put Careerjet's AFFID in .env
9. Run `php artisan serve`
10. Access it on `http://localhost:8000`

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
      "photo": "path/to/photo.jpg"
  }

  Response
  {
      "message": "User has been created successfully.",
      "data": {
        "user": {
          "name": "user",
          "username": "user",
          "photo": "photos/3IOcqYIfSUVDPSvnNvvoClxIY3pHtBuPtfDr24PR.png"
        },
        "jwt_token": "somejwttokeninhere"
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
          "photo": "photos/3IOcqYIfSUVDPSvnNvvoClxIY3pHtBuPtfDr24PR.png"
        },
        "jwt_token": "somejwttokeninhere"
      }
  }
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
        "photo": "photos/3IOcqYIfSUVDPSvnNvvoClxIY3pHtBuPtfDr24PR.png"
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
    "photo" : "path/to/photo.jpg",
  }

  Response
  {
    "message": "User's data has been updated successfully",
    "data": {
      "user": {
        "name": "user",
        "username": "user",
        "photo": "photos/wVpcFkdEartpkDw03rHnPMoIBCG4V9ifpwYRnIVD.png"
      }
    }
  }
```

### Download CV

```
  GET /cv/{id}
```
