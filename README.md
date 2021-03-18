COMO COLOCAR O WEBSITE A FUNCIONAR NA TOTALIDADE NUMA MÁQUINA LOCAL PARA VISUALIZAR ESTE, O CÓDIGO E A BASE DE DADOS:

1º - As ferramentas utilizadas foram o XAMPP para alocar a base de dados phpMyAdmin e o editor para o código foi o NetBeans 12.2;

2º - Depois de fazer download do XAMPP, fazer download da diretoria "projetos" aqui no gitHub e colocá-la dentro da pasta "htdocs" do XAMPP (inclusive e obrigatoriamente a diretoria "projetos");

3º - Abrir o link que se encontra dentro do ficheiro "email-mudar_no_xampp.txt" e visualizar na internet as instruções para enviar um o email de verificação de conta do website através da máquina local usando o GMAIL (com um endereço gmail próprio);

4º - Inicializar o Apache e MySQL no painel do XAMPP e abrir o phpMyAdmin através do botão "Admin" no MySQL;

5º - No phpMyAdmin, criar uma nova base de dados com o nome "auto_beauty_db";

6º - Importar para a BD anteriormente criada as tabelas contidas no ficheiro "auto_beauty_db.sql";

7º - Abrir o website num browser à escolha com o link: "http://localhost/projetos/auto_beauty_website/login_form.php" e começar a experimentar, criando uma conta.


------- NOTAS -------

1 - NÃO PASSAR NENHUM PASSO Á FRENTE, ESPECIALMENTE O 3º PARA PODER ENVIAR E RECEBER O EMAIL DE CONFIRMAÇÃO DE REGISTO DE CONTA PARA ATIVAR ESTA, SENÂO NÃO SERÁ POSSIVÉL FAZER LOGIN;

2 - O WEBSITE FUNCIONARÁ A 100% APENAS CRIANDO A BASE DE DADOS "auto_beauty_db" VAZIA, SE AS TABELAS NÃO EXISTIREM, ESTAS VÃO SENDO CRIADAS AUTOMATICAMENTE AO UTILIZAR O WEBSITE, MAS ASSIM COM A IMPORTAÇÃO DESTAS JÁ SE TEM UM EXEMPLO DO WEBSITE POPULADO.
