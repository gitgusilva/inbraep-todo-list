
# To-Do List

Desenvolvido em virtude do desafio proposto pela inbraep.


## Instalação

A instalação é bem simples, basta fazer um clone do projeto e realizar a instalação das dependências npm e do composer, e após isto será necessário seguir estas etapas:

```bash
  Copie o arquivo .env.example do projeto e renomeei o mesmo apenas para .env e após isto, 
  configure as variáveis do arquivo .env e utilize este comando:

  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=inbraep
  DB_USERNAME=seu_usuario_Aqui
  DB_PASSWORD=sua_senha_aqui

  - php artisan key:generate
```

```bash
  Após realizar o processo acima, será necessário importar o arquivo inbraep.sql
  para um banco de dados que suporte mariaDb ou mysql.

  E assim que for feita a importação do banco de dados, o projeto já estará pronto para ser inicializado. E para isto, você deverá digitar os seguintes comandos:

  - php artisan serve
  - npm run dev

```
## Screenshots de como ficará após a instalação e inicialização.

![App Screenshot](images/img.png?text=To-Do+List+Sem+Resultados) ![App Screenshot](images/img_1.png?text=Após+criar+uma+tarefa)
![App Screenshot](images/img_2.png?text=Edição+da+tarefa) ![App Screenshot](images/img_3.png?text=Tarefa+editada+e+completada)

