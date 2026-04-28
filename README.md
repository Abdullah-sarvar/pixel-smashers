# PIXEL SMASHERS 🎮

### *The #1 Retro Marketplace for Pixel Art Assets*

Pixel Smashers is a specialized marketplace designed for game developers and pixel artists. Whether you're looking for stunning tilesets, character sprites, or unique UI packs, Pixel Smashers provides a robust platform to discover, buy, and sell high-quality digital assets.

---

## 🚀 Key Features

### 🛒 Marketplace & Discovery
- **Extensive Catalog**: Browse through thousands of assets including Tilesets, Characters, Effects, Backgrounds, and UI Packs.
- **Categorization & Filtering**: Easily find what you need with dedicated categories and type-based filtering (Free vs. Paid).
- **Asset Previews**: High-quality previews and detailed descriptions for every asset.

### 👤 User Roles
- **Buyers**: Create an account, manage a personal cart, and track purchase history through a dedicated Orders page.
- **Sellers**: Access a specialized dashboard to upload assets, manage listings, and track their store's performance.
- **Admins**: Powerful moderation tools to manage users and ensure marketplace quality.

### 💼 Commerce System
- **Dynamic Cart**: Add multiple assets to your cart and checkout seamlessly.
- **Order Management**: Comprehensive history of all purchases and downloads.
- **Review System**: Share feedback on assets to help the community.

### 🎨 Retro Aesthetic
- **Cyber-Retro UI**: A unique design system inspired by classic gaming, featuring vibrant purples, golds, and custom pixel-perfect typography.

---

## 🛠️ Technical Stack

**Backend:**
- **Laravel 8**: A robust PHP framework for high-performance backend logic.
- **PHP 8.2**: Leveraging modern language features for efficiency.
- **Sanctum**: Secure API authentication.

**Frontend:**
- **Tailwind CSS**: A utility-first CSS framework for modern, responsive layouts.
- **Laravel Mix**: Streamlined asset compilation and bundling.
- **Google Fonts**: Custom typography using 'Press Start 2P' and 'Rajdhani'.

**Database:**
- **MySQL**: Reliable relational data management.

---

## 📦 Getting Started

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL

### Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/Abdullah-sarvar/pixel-smashers.git
   cd pixel-smashers
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Configure your database credentials in the `.env` file.*

4. **Database Migrations:**
   ```bash
   php artisan migrate
   ```

5. **Build Assets:**
   ```bash
   npm run dev
   ```

6. **Start the Server:**
   ```bash
   php artisan serve
   ```

---

## 📂 Project Structure

- `app/Http/Controllers`: Backend logic for Auth, Marketplace, Cart, and Admin.
- `app/Models`: Core data structures (User, Product, Order, Review, Cart).
- `database/migrations`: Database schema definitions and role management.
- `resources/views`: Interactive Blade templates with a custom retro design system.
- `routes/web.php`: Primary web application routing.

---

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
