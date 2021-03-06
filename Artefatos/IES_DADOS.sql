	    SELECT COUNT(1) AS QTD,
                   SUM(D.ALUNOS_GRADUACAO + ALUNOS_POS_GRADUACAO) AS GRADUACAO_E_POS,
	           SUM(D.PROFESSORES) AS PROFESSORES,
	           SUM(D.FUNCIONARIOS) AS FUNCIONARIOS,
	           SUM(D.CURSOS_GRADUACAO + CURSOS_POS_GRADUACAO_LATU + CURSOS_POS_GRADUACAO_STRICTU) AS CURSOS,
	           SUM(D.EMPRESAS_INCUBADAS) AS EMPRESAS_INCUBADAS,
	           SUM(D.GRUPOS_PESQUISA) AS GRUPOS_PESQUISA,
	           SUM(D.PROJETOS_PESQUISA) AS PROJETOS_PESQUISA,
	           SUM(D.LABORATORIOS) AS LABORATORIOS,
	           
	           SUM(D.ALUNOS_COM_BOLSA_170 + D.ALUNOS_COM_BOLSA_171) AS ALUNOS_COM_BOLSA,
	           SUM(D.PESSOAS_ATENDIDAS_SAUDE) AS PESSOAS_ATENDIDAS_SAUDE,
	           SUM(D.PESSOAS_ATENDIDAS_JURIDICO) AS PESSOAS_ATENDIDAS_JURIDICO,
	           SUM(D.PESSOAS_ATENDIDAS_EDUCACAO) AS PESSOAS_ATENDIDAS_EDUCACAO
	           /*
	           ,SUM(D.LIVROS) AS LIVROS,
	           SUM(D.BIBLIOTECAS) AS BIBLIOTECAS,
	           SUM(D.INCUBADORAS) AS INCUBADORAS
	           */
	 FROM DADOS_IES D 
	WHERE ANO = 2019 OR (id_INSTITUICAO = 2 AND ANO = 2018)