# Preview pages (No Laravel required)

This folder is ONLY for quick visual testing of:
- Book listing search bar / filters
- Admin listing actions: delete + toggle sold

## How to open
Open these files directly in your browser (double-click):

- public/preview/books.html
- public/preview/admin-books.html

Edits you do on admin page (delete/toggle sold) are saved in your browser localStorage, so you can switch between pages and see changes.

Click **Reset** to restore demo data.


NOTE:
- If you open via file://, use the built-in links (same tab). Delete/toggle is saved via window.name so it carries to the next page.
- If you open pages in separate tabs, data may not sync.
