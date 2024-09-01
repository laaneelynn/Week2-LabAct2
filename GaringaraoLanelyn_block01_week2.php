<?php
class Book {
    public $title;
    protected $author;
    private $price;

    // Constructor to initialize properties
    public function __construct($title, $author, $price) {
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
    }

    // Method to get book details
    public function getDetails() {
        return "Title: {$this->title}, Author: {$this->author}, Price: \${$this->price}";
    }

    // Method to set the price
    public function setPrice($price) {
        $this->price = $price;
    }

    // Magic method to handle calls to non-existent methods
    public function __call($name, $arguments) {
        if ($name === 'updateStock') {
            echo "Stock updated for '{$this->title}' with arguments: " . implode(', ', $arguments) . "\n";
        } else {
            echo "Method {$name} does not exist.\n";
        }
    }
}

class Library {
    private $books = [];
    public $name;

    // Constructor to initialize the library's name
    public function __construct($name) {
        $this->name = $name;
    }

    // Method to add a book to the library
    public function addBook(Book $book) {
        $this->books[] = $book;
    }

    // Method to remove a book from the library by title
    public function removeBook($title) {
        foreach ($this->books as $key => $book) {
            if ($book->title === $title) {
                unset($this->books[$key]);
                echo "Book '{$title}' removed from the library.\n";
                return;
            }
        }
        echo "Book '{$title}' not found.\n";
    }

    // Method to list all books in the library
    public function listBooks($message = '') {
        if (empty($this->books)) {
            echo "No books in the library.\n";
            return;
        }

        if (!empty($message)) {
            echo $message;
        } else {
            echo "Books in the library:\n";
        }
        foreach ($this->books as $book) {
            echo $book->getDetails() . "\n";
        }
    }

    // Destructor to clear the library
    public function __destruct() {
        echo "The library '{$this->name}' is now closed.\n";
    }
}

// Create instances of Book
$book1 = new Book("The Great Gatsby", "F. Scott Fitzgerald", 12.99);
$book2 = new Book("1984", "George Orwell", 8.99);

// Create instance of Library
$library = new Library("City Library");

// Add books to the library
$library->addBook($book1);
$library->addBook($book2);

// Attempt to call a non-existent method
$book1->updateStock(50);

// Update the price of a book
$book1->setPrice(12.99);

// List all books
$library->listBooks();

// Remove a book from the library
$library->removeBook("1984");

// List all books after removal
$library->listBooks("Books in the library after removal:\n");

// Destroy the Library object to trigger the destructor
unset($library);

// Brief Explanation //
/* This PHP code defines two classes, Book and Library, to manage a collection of books.
   The Book class has properties for title, author, and price, and methods to get details, set price, and handle non-existent methods.
   The Library class has properties for books and name, and methods to add, remove, and list books, as well as a destructor to clear the library. */
