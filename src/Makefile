DOCUMENTROOT=$(DESTDIR)/www/pages
OWN = -o root -g root
INSTDOCS = 0644
INSTALL = install

DOCS = hwmon.html \
       hwmon.js

PHP_SCRIPTS = hwmon.php
       
all:
	@echo "make all in src"

install:
	@echo "make install in src"
	# below depends on Yocto and the corresponding recipe (meta-core/init/init.bb)
	$(INSTALL) $(OWN) -d $(DOCUMENTROOT)
	$(INSTALL) $(OWN) -m $(INSTDOCS) $(DOCS) $(DOCUMENTROOT)
	$(INSTALL) $(OWN) -m $(INSTDOCS) $(PHP_SCRIPTS) $(DOCUMENTROOT)

clean:
	@echo "make clean in src"
