# File Organizer
Organizar os arquivos por data de criação (ano e mês), tipo de arquivo e tamanho.

## Requisitos funcionais
- RF1: Como usuário eu gostaria de conseguir organizar os arquivos de um diretório separados por ano e mês
- RF2: Como usuário eu gostaria de organizar os arquivos de um diretório por tipo de arquivo
  - RF2.1: Como usuário também gostaria de poder definir um destino para os tipos de arquivos.
- RF3: Como usuário eu gostaria de organizar os arquivos de um diretório por tamanho, poderia organizar em pequeno, médio e grande

### Exemplo de uso
~~~sh
php file-organizer path
php file-organizer --date path 
php file-organizer --type mp3, mp4 path
php file-organizer --type mp3, mp4 --source source --destination 
php file-organizer --size path 
~~~

## Topicos que posso aprender
- [User Storie](https://www.atlassian.com/agile/project-management/user-stories) x enginnering stories
  > As Engenerring Story: As a enginner i want to see unit tests
- Error handling (Exceptions or not)
- Command line php
- I/O php
- Iterators?
