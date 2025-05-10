CREATE DATABASE empresa;

USE empresa;

CREATE TABLE FUNCIONARIO (
    Pnome VARCHAR(50),
    Minicial VARCHAR(50),
    Unome VARCHAR(50),
    Cpf VARCHAR(11) PRIMARY KEY,
    Datanasc DATE,
    Endereco VARCHAR(100),
    Sexo VARCHAR(10),
    Salario DECIMAL(10,2),
    Cpf_supervisor VARCHAR(11),
    Dnr INT
);

CREATE TABLE DEPARTAMENTO (
    Dnome VARCHAR(100),
    Dnumero INT PRIMARY KEY,
    Cpf_gerente VARCHAR(11),
    Data_inicio_gerente DATE
);

CREATE TABLE LOCALIZACOES_DEP (
    Dnumero INT,
    Dlocal VARCHAR(100),
    PRIMARY KEY (Dnumero, Dlocal)
);
 
CREATE TABLE PROJETO (
    Projnome VARCHAR(100),
    Projnumero INT PRIMARY KEY,
    Projlocal VARCHAR(100),
    Dnum INT
);

CREATE TABLE TRABALHA_EM (
    Fcpf VARCHAR(11),
    Pnr INT,
    Horas DECIMAL(5,2),
    PRIMARY KEY (Fcpf, Pnr)
);

CREATE TABLE DEPENDENTE (
    Fcpf VARCHAR(11),
    Nome_dependente VARCHAR(150),
    Sexo VARCHAR(10),
    Datanasc DATE,
    Parentesco VARCHAR(10),
    PRIMARY KEY (Nome_dependente, Fcpf)
);

INSERT INTO DEPARTAMENTO (Dnome, Dnumero, Cpf_gerente, Data_inicio_gerente) VALUES 
('Pesquisa', 5, '33344555587', '1988-05-22'),
('Administração', 4, '98765432168', '1995-01-01'),
('Matriz', 1, '88866555576', '1981-06-19');

INSERT INTO LOCALIZACOES_DEP (Dnumero, Dlocal) VALUES 
(1,'São Paulo'),
(4,'Mauá'),
(5,'Santo André'),
(5,'Itu'),
(5,'São Paulo');

INSERT INTO TRABALHA_EM (Fcpf, Pnr, Horas) VALUES 
('12345678966', 1, 32.5),
('12345678966', 2, 7.5),
('66688444476', 3, 40),
('45345345376', 1, 20),
('45345345376', 2, 20),
('33344555587', 2, 10),
('33344555587', 3, 10),
('33344555587', 10, 10),
('33344555587', 20, 10),
('99988777767', 30, 30),
('99988777767', 10, 10),
('98798798733', 10, 35),
('98798798733', 30, 5),
('98765432168', 30, 20),
('98765432168', 20, 15),
('88866555576', 20, NULL);

INSERT INTO DEPENDENTE (Fcpf, Nome_dependente, Sexo, Datanasc, Parentesco) VALUES 
('33344555587', 'Alicia', 'F', '1986-04-05', 'Filha'),
('33344555587', 'Tiago', 'M', '1983-10-25', 'Filho'),
('33344555587', 'Janaina', 'F', '1958-05-03', 'Esposa'),
('98765432168', 'Antonio', 'M', '1942-02-28', 'Filho'),
('12345678966', 'Michael', 'M', '1988-01-04', 'Filho'),
('12345678966', 'Alicia', 'F', '1988-12-30', 'Filha'),
('12345678966', 'Elizabeth', 'F', '1967-05-05', 'Esposa');

INSERT INTO FUNCIONARIO (Pnome, Minicial, Unome, Cpf, Datanasc, Endereco, Sexo, Salario, Cpf_supervisor, Dnr) VALUES 
('João', 'B', 'Silva', '12345678966', '1965-01-09', 'Rua das Flores, 751, São Paulo, SP', 'M', 30000, '33344555587', 5),
('Fernando', 'T', 'Wong', '33344555587', '1955-12-08', 'Rua da Lapa, 34, São Paulo, SP', 'M', 40000, '88866555576', 5),
('Alice', 'J', 'Zelaya', '99988777767', '1968-01-19', 'Rua Souza Lima, 35, Curitiba, PR', 'F', 25000, '98765432168', 4),
('Jennifer', 'S', 'Souza', '98765432168', '1941-06-20', 'Av. Arthur de Lima, 54, Santo André, SP', 'F', 43000, '88866555576', 4),
('Ronaldo', 'K', 'Lima', '66688444476', '1962-09-15', 'Rua Rebouças, 65, Piracicaba, SP', 'M', 38000, '33344555587', 5),
('Joice', 'A', 'Leite', '45345345376', '1972-07-31', 'Av. Lucas Obes, 74, São Paulo, SP', 'F', 25000, '33344555587', 5),
('André', 'V', 'Pereira', '98798798733', '1969-03-29', 'Rua Timbira, 35, São Paulo, SP', 'M', 25000, '98765432168', 4),
('Jorge', 'E', 'Brito', '88866555576', '1937-11-10', 'Rua do Horto, 35, São Paulo, SP', 'M', 55000, NULL, 1);

INSERT INTO PROJETO (Projnome, Projnumero, Projlocal, Dnum) VALUES 
('ProdutoX', 1, 'Santo André', 5),
('ProdutoY', 2, 'Itu', 5),
('ProdutoZ', 3, 'São Paulo', 5),
('Informatização', 10, 'Mauá', 4),
('Reorganização', 20, 'São Paulo', 1),
('Novos benefícios', 30, 'Mauá', 4);


ALTER TABLE FUNCIONARIO ADD FOREIGN KEY (Cpf_supervisor) REFERENCES FUNCIONARIO (Cpf);
ALTER TABLE FUNCIONARIO ADD FOREIGN KEY (Dnr) REFERENCES DEPARTAMENTO (Dnumero);
ALTER TABLE DEPARTAMENTO ADD FOREIGN KEY (Cpf_gerente) REFERENCES FUNCIONARIO (Cpf);
ALTER TABLE PROJETO ADD FOREIGN KEY (Dnum) REFERENCES DEPARTAMENTO (Dnumero);
ALTER TABLE DEPENDENTE ADD FOREIGN KEY (Fcpf) REFERENCES FUNCIONARIO (Cpf);
ALTER TABLE TRABALHA_EM ADD FOREIGN KEY (Fcpf) REFERENCES FUNCIONARIO (Cpf);
ALTER TABLE TRABALHA_EM ADD FOREIGN KEY (Pnr) REFERENCES PROJETO (Projnumero);
ALTER TABLE LOCALIZACOES_DEP ADD FOREIGN KEY (Dnumero) REFERENCES DEPARTAMENTO (Dnumero);

