# Whatsapp API Documentation

## Authentication

### Register
**Method:** `POST`
**Endpoint:** `/register`
**Description:** Register a new user

**Request Body:**
```json
{
    "name": "string",
    "email": "string",
    "password": "string"  
}

#### Responses:
### 400 Bad Request
```json
{
    "error": "validation error"
}

## Responses:
### 201 Created
```json
{
    "message": "User registered successfully",
    "data": {
        "id": 1,
        "name": "Ajmal",
        "email": "ajmal@gmail.com"
    }
}


### Login
**Method:** `POST`
**Endpoint:** `/login`
**Description:** Authenticates a user

**Request Body:**
```json
{
    "email": "string",
    "password": "string"  
}

## Responses:
### 200 Ok
```json
{
    "token": "eyJhbGciOiJI1NiIsInR5cCI6IKpXVCJ9..."
}

### 401 Unauthorized
```json
{
    "error": "Invalid credentials"
}


## Chatroom Endpoints

### Create Chatroom 
**Method:** `POST`
**Endpoint:** `/chatroom/create`
**Description:** Creates a new chatroom

**Request Body:**
```json
{
    "name": "string",
    "max_members": 50  
}

## Responses:
### 201 Created
```json
{
    "id": 1,
    "name": "General",
    "max_members": 50
}

### 400 Bad Request
```json
{
    "error": "validation error"
}


### List Chatrooms
**Method:** `GET`
**Endpoint:** `/chatrooms`
**Description:** Lists all chatrooms with pagination

**Request Body:**
```json
{
    "id": "integer",
    "max_members": 50,  
}

## Responses:
### 200 Ok
```json
[
    {
        "id": 1,
        "name": "General",
        "max_members": 100
    }
]

### Enter Chatroom
**Method:** `POST`
**Endpoint:** `/chatroom/{id}/enter`
**Description:** Adds a user to the specified chatroom

**Request Body:**
```json
{
    "id": "integer"
}

## Responses:
### 200 Ok
```json
{
    "message": "User entered the chatroom successfully"
}

### 404 Not Found
```json
{
    "error": "Chatroom not found"
}

### Leave Chatroom
**Method:** `POST`
**Endpoint:** `/chatrooms/{id}/leave`
**Description:** Removes a user from the specified chatroom

**Request Body:**
```json
{
    "id": "integer",  
}

## Responses:
### 200 Ok
```json
{
    "message": "User left the chatroom successfully"
}

### 404 Not Found
```json
{
    "error": "Chatroom not found"
}


## Message Endpoints
### Send Message
**Method:** `POST`
**Endpoint:** `/message/send`
**Description:** Sends a message to a chatroom

**Request Body:**
```json
{
    "chatroom_id": 1,
    "message": "Hello world",
    "attachment": "file"  
}

## Responses:
### 201 Created
```json
{
    "id": 1,
    "chatroom_id": 1,
    "user_id": 1,
    "message": "Hello world",
    "attachment_path": "/uploads/images/photo.jpg"
    "created_at": "2024-11-22T10:00:00Z"
}

### 400 Bad Request
```json
{
    "error": "Validation error"
}

### List Messages
**Method:** `GET`
**Endpoint:** `/chatroom/{id}/messages`
**Description:** List all messages in a specified chatroom

**Request Body:**
```json
{
    "id": "integer"
}

## Responses:
### 200 Ok
```json
[
    {
        "id": 1,
        "user_id": 1,
        "message": "Hello everyone",
        "attachment_path": null,
        "created_at": "2024-11-22T10:00:00Z"
    },
    {
        "id": 2,
        "user_id": 2,
        "message": "Welcome to the group",
        "attachment_path": "uploads/images/welcome.jpg",
        "created_at": "2024-11-22T10:00:00Z"
    }
]

### Error Responses:
## 401 Unauthorized
```json
{
    "error": "Unauthorized"
}