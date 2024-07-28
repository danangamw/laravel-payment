<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Payments App

## Take Home Technical Test: Payments App

Fatures:

1.  **Basic Auth**
2.  **Transaction History**
3.  **Deposit**
4.  **Withdraw**

**Running the Application:**

To run the application, follow these steps:

1. **Install Dependencies:**
    - Install Node.js dependencies: `npm install`
    - Build the frontend assets: `npm run build`
    - Install PHP dependencies: `composer install`
2. **Database Setup:**
    - Change .env database config
    - Run database migrations: `php artisan migrate --seed`
3. **Start the Queue Worker:**
    - Start the queue worker process: `php artisan queue`
4. **Run the Development Server:**
    - Start the Laravel development server: `php artisan serve`
5. **Frontend Development (Optional):**
    - For live reload of frontend changes while developing: `npm run dev` (in a separate terminal)

**Troubleshooting:**

-   **Views not loading:** If views are not rendering correctly, run `npm run dev` in a separate terminal.
-   **Balance not updating:** If the wallet balance doesn't update immediately after a transaction, try refreshing the page.
-   **Balance not updating:** If the wallet balance still doesn't update immediately after a transaction, Start the queue worker process: `php artisan queue`.

**Note:** To ensure proper functionality of the deposit and withdraw features, the queue service must run as a separate process.
