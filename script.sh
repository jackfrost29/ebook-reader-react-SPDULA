# build the "./src/Bundle.js" file
npm run build-es


# copy index.php file into site
sudo cp index.php /var/www/reader-v2-injection/

# copy php files into site
sudo cp -r __php/ /var/www/reader-v2-injection/

# copy css files into site
sudo cp __bundle/{bundle.css,bundle.css.map} /var/www/reader-v2-injection/__css/

# copy js files into site
sudo cp __bundle/{bundle.js,bundle.js.map} /var/www/reader-v2-injection/__js/