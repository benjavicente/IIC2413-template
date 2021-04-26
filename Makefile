HOST = user@example.com


.SILENT: start-server
.PHONY: start-server
start-server: web/public
	cd web/public && php -S localhost:8080


.PHONY: upload-web
upload-web: web/partials/ web/lib/ web/public/
	rsync -u -r web/partials/ $(HOST):~/partials
	rsync -u -r web/lib/ $(HOST):~/lib
	rsync -u -r web/public/ $(HOST):~/Sites


.PHONY: upload-data
upload-data: data/
	rsync -u -r data/ $(HOST):~/project/data


.SILENT: setup-python
.PHONY: setup-python
setup-python: requirements.txt
	test -d .venv || ( \
		python3 -m venv .venv
		&& . .venv/bin/activate \
		&& python -m pip -q install pip --upgrade \
		&& pip -q install -r requirements.txt \
	)
	echo "Use \`source .venv/bin/activate\` to activate the enviroment"
