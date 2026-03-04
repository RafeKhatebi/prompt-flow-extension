# PromptFlow - AI Prompt Management System

A Laravel-based web application for managing and injecting AI prompts into various AI tools like ChatGPT, Claude, and others.

## Features

- ✅ User authentication (register, login, logout)
- ✅ CRUD operations for prompts (create, read, update, delete)
- ✅ Search and filter prompts by title, content, or tags
- ✅ Inject prompts into AI textareas or copy to clipboard
- ✅ Visual highlighting of selected prompts
- ✅ Export/Import prompts as JSON for team sharing
- ✅ Admin panel to view all users' prompts
- ✅ Responsive Bootstrap UI (mobile-friendly)
- ✅ Toast notifications for user actions
- ✅ Role-based access control

## Requirements

- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL/SQLite

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd promptflow
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install JavaScript dependencies:
```bash
npm install
```

4. Copy environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Configure database in `.env`:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=promptflow
DB_USERNAME=root
DB_PASSWORD=
```

7. Run migrations:
```bash
php artisan migrate
```

8. (Optional) Seed sample data:
```bash
php artisan db:seed
```

9. Build assets:
```bash
npm run dev
```

10. Start the development server:
```bash
php artisan serve
```

Visit: http://localhost:8000

## Usage

### Creating Prompts
1. Register/Login to your account
2. Click "Create New Prompt"
3. Fill in title, content, and optional tags
4. Save the prompt

### Injecting Prompts
1. Navigate to your prompts list
2. Click "Inject/Copy" button next to any prompt
3. If a textarea exists on the page, it will be filled automatically
4. Otherwise, the content is copied to your clipboard

### Search & Filter
- Use the search bar to filter prompts by title, content, or tags
- Results update in real-time as you type

### Export/Import
- **Export**: Click "Export" to download all your prompts as JSON
- **Import**: Click "Import", select a JSON file, and upload

## Admin Features

Users with `role = 'admin'` can:
- View all prompts from all users
- Manage user accounts

To make a user admin, update the database:
```sql
UPDATE users SET role = 'admin' WHERE email = 'admin@example.com';
```

## Security

- All routes are protected with authentication middleware
- CSRF protection on all forms
- Users can only access their own prompts (except admins)
- Policy-based authorization
- XSS protection via Laravel's Blade templating

## Testing

Refer to `TESTING_CHECKLIST.md` for comprehensive testing guidelines.

## Deployment

### Production Setup

1. Set environment to production in `.env`:
```
APP_ENV=production
APP_DEBUG=false
```

2. Build production assets:
```bash
npm run build
```

3. Optimize Laravel:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

4. Set proper file permissions:
```bash
chmod -R 755 storage bootstrap/cache
```

### Deployment Platforms

- **Laravel Forge**: Automated deployment and server management
- **DigitalOcean**: App Platform or Droplet with manual setup
- **AWS**: EC2 or Elastic Beanstalk
- **Heroku**: With PostgreSQL add-on

## License

MIT License
