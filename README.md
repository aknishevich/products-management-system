# products-management-system

To deploy this application on your server you should have PHP >=7.1 and install SQLite.

Maybe you will need to enable PDO sqlite in php.ini file.

Application entry point located in the root directory as index.php

There is 5 pages:
  - Home (/);
  - Add products (/addProduct);
  - Edit products (/editProducts);
  - Attributes (/attributes);
  - Product (/product?id=1);

On the home page / displayed the list of products with paginations. If you ckick on some product item you will go
to the Product page where will be provided more info including attributes.
On Edit Products page you can change products list and delete it.
On Add product page you can add new product.
On Attributes List page you can check attribute IDs you should use to add attributes into Products.
