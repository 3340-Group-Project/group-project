/**
 * Preview-only data store for static HTML testing (no Laravel / DB required).
 * It saves edits (delete/toggle sold) to localStorage so you can see changes.
 */
const PREVIEW_STORAGE_KEY = "campusShelfPreviewBooksV1";

const DEFAULT_BOOKS = [
  {
    "id": 1,
    "title": "Introduction to Algorithms",
    "course_code": "COMP3340",
    "price": 10.0,
    "format": "Book Cover",
    "condition": "Good",
    "sold": false
  },
  {
    "id": 2,
    "title": "Database Systems: The Complete Book",
    "course_code": "COMP3340",
    "price": 19.0,
    "format": "Paperback",
    "condition": "Like New",
    "sold": false
  },
  {
    "id": 3,
    "title": "Operating System Concepts",
    "course_code": "COMP3000",
    "price": 15.0,
    "format": "Hardcover",
    "condition": "Fair",
    "sold": false
  },
  {
    "id": 4,
    "title": "Clean Code",
    "course_code": "COMP2120",
    "price": 25.0,
    "format": "Paperback",
    "condition": "Good",
    "sold": false
  },
  {
    "id": 5,
    "title": "The Pragmatic Programmer",
    "course_code": "COMP2120",
    "price": 30.0,
    "format": "Paperback",
    "condition": "Like New",
    "sold": true
  },
  {
    "id": 6,
    "title": "Artificial Intelligence: A Modern Approach",
    "course_code": "COMP4110",
    "price": 40.0,
    "format": "Hardcover",
    "condition": "Good",
    "sold": false
  },
  {
    "id": 7,
    "title": "Design Patterns: Elements of Reusable OOP",
    "course_code": "COMP3150",
    "price": 18.0,
    "format": "Paperback",
    "condition": "Fair",
    "sold": false
  },
  {
    "id": 8,
    "title": "Refactoring",
    "course_code": "COMP3150",
    "price": 22.0,
    "format": "Paperback",
    "condition": "Good",
    "sold": false
  },
  {
    "id": 9,
    "title": "Structure and Interpretation of Computer Programs",
    "course_code": "COMP2560",
    "price": 12.0,
    "format": "Paperback",
    "condition": "Good",
    "sold": false
  },
  {
    "id": 10,
    "title": "Computer Networks",
    "course_code": "COMP3340",
    "price": 16.0,
    "format": "Paperback",
    "condition": "Good",
    "sold": false
  }
];

function loadBooks() {
  try {
    const raw = localStorage.getItem(PREVIEW_STORAGE_KEY);
    if (!raw) return DEFAULT_BOOKS.slice();
    const parsed = JSON.parse(raw);
    if (!Array.isArray(parsed)) return DEFAULT_BOOKS.slice();
    return parsed;
  } catch (e) {
    return DEFAULT_BOOKS.slice();
  }
}

function saveBooks(books) {
  localStorage.setItem(PREVIEW_STORAGE_KEY, JSON.stringify(books));
}

function resetBooks() {
  localStorage.removeItem(PREVIEW_STORAGE_KEY);
  location.reload();
}
