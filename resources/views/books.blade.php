<!DOCTYPE html>
<html>
    <head>
        <title>Campus Swap</title>
        <link rel="stylesheet" href="{{ asset('css/books.css') }}"/>
        
    </head>
    <body id="book">
        <nav>
        <ul>
            <li><img src="{{ asset('images/logo.svg') }}" class="logo" alt="logo" /><a href="#home">Campus Shelf</a></li> <!--should display text bigger-->
            <li><a href="#about">About</a></li>
            <li><a href="#wiki">Wiki</a></li>
            <li><a href="#book">Book Listings</a></li>
            <li><a href="#contact">Contact us</a></li>
		</ul>
        </nav>

        <!--add random squares that are clickable (to do different page)-->
        <main>
            <section class="container">
                <!-- search bar-->
                <div class="a1">
                    <label class="search-label" for="search">Search for Books</label>
                    <input type="text" id="search" name="search">
                </div>

                <!-- filter -->
                <div class="a2">
                    <!-- adding mock data for now -> later add from database-->
                    <select id="filter" name="filter">
                        <option value="Filter">Filter</option>
                        <option value="apple">Apple</option>
                        <option value="banana">Banana</option>
                        <option value="cherry">Cherry</option>
                        <option value="orange">Orange</option>
                    </select>
                </div>
                <div class="b1">
                    <a href="book-details.html" class="card-link">
                        <!-- add flexbox inside as it good for laying out the contents of a grid cell -->
                        <div class="card">  
                            <img src="{{ asset('images/book1.webp') }}" alt="Book Cover"/>
                            <div class="card-content">
                                <h2>Book posting name</h2>
                                <p>Price: $20</p>
                                <p>List of tags here </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="b2">
                    <a href="book-details.html" class="card-link">
                        <!-- add flexbox inside as it good for laying out the contents of a grid cell -->
                        <div class="card">  
                            <img src="{{ asset('images/book2.jpg') }}" alt="Book Cover"/>
                            <div class="card-content">
                                <h2>Book posting name</h2>
                                <p>Price: $30</p>
                                <p>List of tags here </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="b3">
                    <a href="book-details.html" class="card-link">
                        <!-- add flexbox inside as it good for laying out the contents of a grid cell -->
                        <div class="card">  
                            <img src="{{ asset('images/book3.jpg') }}" alt="Book Cover"/>
                            <div class="card-content">
                                <h2>Book posting name</h2>
                                <p>Price: $25</p>
                                <p>List of tags here </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="b4">
                   <a href="book-details.html" class="card-link">
                        <!-- add flexbox inside as it good for laying out the contents of a grid cell -->
                        <div class="card">  
                            <img src="{{ asset('images/book4.jpg') }}" alt="Book Cover"/>
                            <div class="card-content">
                                <h2>Book posting name</h2>
                                <p>Price: $25</p>
                                <p>List of tags here </p>
                            </div>
                        </div>
                    </a> 
                </div>
                <div class="b5">
                    <a href="book-details.html" class="card-link">
                        <!-- add flexbox inside as it good for laying out the contents of a grid cell -->
                        <div class="card">  
                            <img src="{{ asset('images/book5.jpg') }}" alt="Book Cover"/>
                            <div class="card-content">
                                <h2>Book posting name</h2>
                                <p>Price: $25</p>
                                <p>List of tags here </p>
                            </div>
                        </div>
                    </a> 
                </div>
                <div class="b6">
                    <a href="book-details.html" class="card-link">
                        <!-- add flexbox inside as it good for laying out the contents of a grid cell -->
                        <div class="card">  
                            <img src="{{ asset('images/book6.jpg') }}" alt="Book Cover"/>
                            <div class="card-content">
                                <h2>Book posting name</h2>
                                <p>Price: $25</p>
                                <p>List of tags here </p>
                            </div>
                        </div>
                    </a> 
                </div>              
            </section>
        </main>
    </body>
</html>
