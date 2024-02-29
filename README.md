# File Organizer
Organizar os arquivos por data de criação (ano e mês), tipo de arquivo e tamanho.

## Requisitos funcionais
- RF1: Como usuário eu gostaria de conseguir organizar os arquivos de um diretório separados por ano e mês
- RF2: Como usuário eu gostaria de organizar os arquivos de um diretório por tipo de arquivo
  - RF2.1: Como usuário também gostaria de poder definir um destino para os tipos de arquivos.
- RF3: Como usuário eu gostaria de organizar os arquivos de um diretório por tamanho, poderia organizar em pequeno, médio e grande (melhoria)
### Exemplo de uso

- Sempre informe --source --destination caso queria controlar a entrada e saida, por padrão irá pegar o diretório atual para realizar
as operações

~~~sh
php file-organizer --date
php file-organizer --type
php file-organizer --type="mp3, mp4, jpg" 
php file-organizer --type="mp3, mp4, jpg" --source origem --destination destino
~~~

## Topicos que posso aprender
- [User Storie](https://www.atlassian.com/agile/project-management/user-stories) x enginnering stories
  > As Engenerring Story: As a enginner i want to see unit tests
- Error handling (Exceptions or not)
- Command line php
- I/O php
- Iterators


## Links 
* https://www.php.net/manual/en/features.commandline.usage.php
* https://www.php.net/manual/en/function.getopt.php
* ~~https://www.youtube.com/watch?v=5yhJMcCVNSI~~
* https://www.php.net/manual/en/ref.readline.php
* https://www.php.net/manual/en/class.iterator.php
* https://www.php.net/manual/en/class.recursiveiteratoriterator.php
* https://www.php.net/manual/en/class.recursivedirectoryiterator.php
* https://www.php.net/manual/en/class.recursivecallbackfilteriterator.php
* https://www.php.net/manual/en/class.splfileinfo.php
* https://getopt-php.github.io/getopt-php/example.html
* https://github.com/box-project/box
* https://www.php.net/manual/en/intro.phar.php