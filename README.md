# Ebook Reader for SPDULA
The project was initiated as part of the digitalization attempt of the Dhaka University Central Library, Dhaka, Bangladesh. It's a basic digital E-book reader for the SPDULA (Software Project for Dhaka University Library Automation) project.

Although the SPDULA project is php (5.3.3) based, the E-book reader is built using the react.js javascript library. The philosophy behind using react.js came from the attempt to modernize and upgrade the SPDULA project, So that all the good features of react.js (scalability and maintainance) could be leveraged.

### Project structure
1. The Book reader is not a Single Page Application (SPA), which is used in a large portion of react projects out there.
2. The Header and footer section at the top and bottom of the pages are populated in the server side using php. The content section in the middle, which contains the actual book-reader, is inflated on client-side using react.js. The reason behind this mechanism is that, the web-app uses a complex mechanism for compiling The various meues and options, which are also dependent on the user and his/her privilage. To implement it using react.js would be a big undertaking given the scope and time for the project.
3. The react.js App is compiled into a bundle.js file inside the `__bundle` folder as `book-reader-bundle.js` file, which is the shipped from inside the php website as a javascript file. The bundler used to bundle the react.js app is `ES-Build`.
4. The reader displays first 20 pages of the archived books/resource (The number of pages shall be increased later).
5. There are both **single** and **double page** layouts.
6. The reader can be changed to **full-screen mode**.
7. The page can be zoomed for upto `250%`.
8. Sample book opened in E-book reader: https://dulis.library.du.ac.bd/index.php?eBook=536195.pdf
