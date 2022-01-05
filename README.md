<div align="center">

![LogoFlare](https://raw.githubusercontent.com/EduardoFSilva/FlareEditor/main/public/img/logo-flare.png)

</div>
<br>
<h4 align="center">Site web de edição de mensagens de emails comerciais</h4>

<hr/>

<div align="center">

[![Bootstrap](https://img.shields.io/badge/Bootstrap%204.6-%23563D7C.svg?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)
[![Laravel](https://img.shields.io/badge/laravel%208.75-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com/)
[![MySQL](https://img.shields.io/badge/MySQL%20>=5.7-008CC1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com)
[![PHP](https://img.shields.io/badge/php%207.3.31-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net)
[![XAMPP](https://img.shields.io/badge/xampp%207.3.31-F54A2A?style=for-the-badge&logo=xampp&logoColor=white)](https://www.apachefriends.org/pt_br/index.html)

</div>

# **Requisitos Minimos**

*   Composer 2.1.9
*   NPM 6.14 ou superior
*   Apache 2.4
*   PHP 7.3
*   MySQL Server 5.7 ou superior

# **Instalação**



#### 1.   Clone o repositório para uma pasta vazia utilizando o comando abaixo
```bash
git clone https://github.com/EduardoFSilva/FlareEditor.git .
```
#### 2.   Rode o comando de instalação do composer para baixar as dependencias
```bash
composer install
```
#### 3.   Faça uma cópia do arquivo **.env.example** e a renomeie para **.env**
<br>

#### 4.   Edite as configurações no arquivo .env de acordo com seu banco de dados. Siga os passos abaixos para um dos softwares de banco de dados. 
Caso não tenha nenhum instalado e deseja somente testar a aplicao siga a configuração por SQLite

#### 4.1 **Configuração SQLite**

##### 4.1.1 Copie o arquivo **empty.db** e o renomeie para **flareeditor.db**

##### 4.1.2 Configure o arquivo .env de acordo com o abaixo

```ini
DB_CONNECTION=sqlite
DB_HOST=
DB_PORT=
DB_DATABASE=./flareeditor.db
DB_USERNAME=
DB_PASSWORD=
```

#### 4.2 **Configuração MySQL**
<br>

##### 4.2.1 Abra seu sistema gerenciador de banco dados de preferencia e crie um esquema com o nome **flareeditor**

##### 4.2.2 Caso prefira utilizar a linha de comando use o seguinte comando:

```bash
  mysql -h localhost -P 3306 -u root -p
```
No MySQL por padrão o host será localhost, a porta será 3306 e usuário e senha serão root, mas podem variar de máquina para máquina

##### 4.2.3 Configure o arquivo .env de acordo com o abaixo

```ini
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=flareeditor
DB_USERNAME=root
DB_PASSWORD=root
```
OBS: Se você estiver utilzando o XAMPP a senha será vazia

#### 5.    Gere a chave da aplicação utilizando o comando abaixo
```bash
  php artisan key:generate
```
#### 6.    Execute o comando para gerar a estrutura de banco de dados
```bash
  php artisan migrate
```
# **Execução**
## Método 1. Laravel Development Server
1. Abra o terminal na pasta do projeto e execute o comando abaixo
```bash
    php artisan serve
```
2. Acesse a URL abaixo em seu navegador
```
    http://localhost:8000
```

## Método 2. Configuração De Virtual Host No Apache
1. Na pasta onde o Apache está instalado, abra o arquivo <span>**/**</span>**conf/httpd.conf** e adicione acima da diretiva **Listen 80** ou **Listen 127.0.0.1:80** o comando Listen para um endereço local que esteja livre como no exemplo abaixo e salve as alterações:
```markdown
# Endereço Flare Editor
Listen 127.0.0.2:80
# Endereços Padrao
Listen 127.0.0.1:80 
Listen 80 
```
2. Na pasta onde o Apache está instalado, abra o arquivo <span>**/**</span>**conf/extra/httpd-vhosts.conf** e adicione o virtual host de acordo com as regras abaixo:
* O Endereço em frente a **VirtualHost** deve ser o mesmo que o configurado em **httpd.conf**
* **DocumentRoot** deve aponta para a pasta public do projeto. (Nota: para usuários de Windows substitua a **\\** por **/**)
* **ServerName** deve ser uma URL que não esteja "ocupada", como por exemplo **flare.editor.local/**
#### Exemplo de VirtualHost
```
<VirtualHost 127.0.0.5:80>
    DocumentRoot "C:/xampp/htdocs/FlareEditor"
    ServerName flare.editor.local
</VirtualHost>
```

3. Abra o arquivo hosts de seu sistema operacional
#### Localização de arquivo de hosts
###### **Windows:** C:\Windows\System32\drivers\etc\hosts
###### **MacOS/Linux:** <span>/</span>etc/hosts
###### `Nota: Privilégios administrativos são requeridos para se editar este arquivo`
<br>

4. Adicione a linha como a do exemplo no fim do arquivo seguindos as regras
* **Primeiro valor**: deve ser igual ao endereço IP de seu Virtual Host
* **Segundo valor**: deve ser igual ao ***ServerName*** de seu Virtual Host
#### Exemplo de configuração de arquivo hosts
```
 127.0.0.5    flare.editor.local
```


5.    Inicie seu servidor apache e acesse o endereço configurado no arquivo hosts e ServerName.
#### Exemplo de endereço web de desenvolvimento
```
http://flare.editor.local/
```
`Nota: Para as proximas execuções só é necessário que o servidor apache esteja em execução para que o endereço de desenvolvimento fique disponível`

# **Construido Com**
* [Admin LTE](https://adminlte.io/)
* [Bootstrap](https://getbootstrap.com)
* [CodeMirror](https://codemirror.net/)
* [DataTables](https://datatables.net/)
* [FontAwesome](https://fontawesome.com/)
* [Laravel](https://laravel.com/)
* [MySQL](https://www.mysql.com)
* [PHP](https://www.php.net)
* [Summernote](https://summernote.org/)
* [XAMPP](https://www.apachefriends.org/pt_br/index.html)

# **Autor**
* Eduardo Fernandes Silva

