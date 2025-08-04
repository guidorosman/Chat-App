# 💬 Realtime Chat App

A realtime chat application built with with Laravel, Livewire, Laravel Reverb and Taildwind CSS.

## ✨ Features

- User authentication with Laravel Sanctum
- 1-on-1 real-time chat
- Instant messaging with Laravel Reverb (WebSockets)
- Reactive components using Livewire
- Modern UI with Tailwind CSS
- Session management and route protection with middleware

## 🚀 Installation

1. **Clone the repository**

```bash
git clone https://github.com/your-username/chat-app.git
cd chat-app
```

2. **Install PHP and JS dependencies**

```bash
composer install
npm install && npm run dev
```

3. **Set up environment file**
```bash   
cp .env.example .env
php artisan key:generate
```

Configure database and broadcasting settings in .env:
```bash  
DB_DATABASE=chat
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=pusher

PUSHER_APP_ID=your-app-id
PUSHER_APP_KEY=your-app-key
PUSHER_APP_SECRET=your-app-secret
PUSHER_HOST=127.0.0.1
PUSHER_PORT=6001
PUSHER_SCHEME=http
```

4. **Run migrations**
```bash  
php artisan migrate
```

5. **Start Laravel Reverb WebSocket server**
```bash  
php artisan reverb:start
```

6. **Start Laravel development server**
```bash  
php artisan serve
```
   
## 👤 Autor

Guido Ezequiel Rosman
