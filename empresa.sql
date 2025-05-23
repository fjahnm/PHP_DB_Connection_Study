-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `empresa`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_dependentes` (IN `cpf_funcionario` VARCHAR(11))   BEGIN
    SELECT 
        d.Nome AS Nome_dependente,
        d.Sexo,
        d.DataNasc,
        d.Parentesco
    FROM 
        Dependentes d
        INNER JOIN Funcionarios f ON d.CPF_Funcionario = f.CPF
    WHERE 
        f.CPF = cpf_funcionario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_listar_projetos_funcionario` (IN `cpf_funcionario` VARCHAR(11))   BEGIN
    SELECT 
        p.ProjNome,
        p.ProjLocal,
        p.ProjNumero,
        fp.Horas
    FROM 
        Funcionarios f
        INNER JOIN Funcionario_Projeto fp ON f.CPF = fp.CPF_Funcionario
        INNER JOIN Projetos p ON fp.ProjNumero = p.ProjNumero
    WHERE 
        f.CPF = cpf_funcionario;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura para tabela `departamento`
--

CREATE TABLE `departamento` (
  `Dnome` varchar(100) DEFAULT NULL,
  `Dnumero` int(11) NOT NULL,
  `Cpf_gerente` varchar(11) DEFAULT NULL,
  `Data_inicio_gerente` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `departamento`
--

INSERT INTO `departamento` (`Dnome`, `Dnumero`, `Cpf_gerente`, `Data_inicio_gerente`) VALUES
('Matriz', 1, '88866555576', '1981-06-19'),
('Administração', 4, '98765432168', '1995-01-01'),
('Pesquisa', 5, '33344555587', '1988-05-22'),
('Desenvolvimento', 8, '05353023048', '2025-05-10');

-- --------------------------------------------------------

--
-- Estrutura para tabela `dependente`
--

CREATE TABLE `dependente` (
  `Fcpf` varchar(11) NOT NULL,
  `Nome_dependente` varchar(150) NOT NULL,
  `Sexo` varchar(10) DEFAULT NULL,
  `Datanasc` date DEFAULT NULL,
  `Parentesco` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `dependente`
--

INSERT INTO `dependente` (`Fcpf`, `Nome_dependente`, `Sexo`, `Datanasc`, `Parentesco`) VALUES
('12345678966', 'Alicia', 'F', '1988-12-30', 'Filha'),
('33344555587', 'Alicia', 'F', '1986-04-05', 'Filha'),
('98765432168', 'Antonio', 'M', '1942-02-28', 'Filho'),
('12345678966', 'Elizabeth', 'F', '1967-05-05', 'Esposa'),
('33344555587', 'Janaina', 'F', '1958-05-03', 'Esposa'),
('12345678966', 'Michael', 'M', '1988-01-04', 'Filho'),
('33344555587', 'Tiago', 'M', '1983-10-25', 'Filho');

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `Pnome` varchar(50) DEFAULT NULL,
  `Minicial` varchar(50) DEFAULT NULL,
  `Unome` varchar(50) DEFAULT NULL,
  `Cpf` varchar(11) NOT NULL,
  `Datanasc` date DEFAULT NULL,
  `Endereco` varchar(100) DEFAULT NULL,
  `Sexo` varchar(10) DEFAULT NULL,
  `Salario` decimal(10,2) DEFAULT NULL,
  `Cpf_supervisor` varchar(11) DEFAULT NULL,
  `Dnr` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `funcionario`
--

INSERT INTO `funcionario` (`Pnome`, `Minicial`, `Unome`, `Cpf`, `Datanasc`, `Endereco`, `Sexo`, `Salario`, `Cpf_supervisor`, `Dnr`) VALUES
('Felipe', 'J', 'Macedo', '12345685239', '2004-08-21', 'Rua A. Fátima 778 - Canoas', 'M', 4800.00, '33344555587', 4),
('João', 'B', 'Silva', '12345678966', '1965-01-09', 'Rua das Flores, 751, São Paulo, SP', 'M', 30000.00, '33344555587', 5),
('Fernando', 'T', 'Wong', '33344555587', '1955-12-08', 'Rua da Lapa, 34, São Paulo, SP', 'M', 40000.00, '88866555576', 5),
('Joice', 'A', 'Leite', '45345345376', '1972-07-31', 'Av. Lucas Obes, 74, São Paulo, SP', 'F', 25000.00, '33344555587', 5),
('Ronaldo', 'K', 'Lima', '66688444476', '1962-09-15', 'Rua Rebouças, 65, Piracicaba, SP', 'M', 38000.00, '33344555587', 5),
('Jorge', 'E', 'Brito', '88866555576', '1937-11-10', 'Rua do Horto, 35, São Paulo, SP', 'M', 55000.00, NULL, 1),
('Jennifer', 'S', 'Souza', '98765432168', '1941-06-20', 'Av. Arthur de Lima, 54, Santo André, SP', 'F', 43000.00, '88866555576', 4),
('André', 'V', 'Pereira', '98798798733', '1969-03-29', 'Rua Timbira, 35, São Paulo, SP', 'M', 25000.00, '98765432168', 4),
('Alice', 'J', 'Zelaya', '99988777767', '1968-01-19', 'Rua Souza Lima, 35, Curitiba, PR', 'F', 25000.00, '98765432168', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `localizacoes_dep`
--

CREATE TABLE `localizacoes_dep` (
  `Dnumero` int(11) NOT NULL,
  `Dlocal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `localizacoes_dep`
--

INSERT INTO `localizacoes_dep` (`Dnumero`, `Dlocal`) VALUES
(1, 'São Paulo'),
(4, 'Mauá'),
(5, 'Itu'),
(5, 'Santo André'),
(5, 'São Paulo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `projeto`
--

CREATE TABLE `projeto` (
  `Projnome` varchar(100) DEFAULT NULL,
  `Projnumero` int(11) NOT NULL,
  `Projlocal` varchar(100) DEFAULT NULL,
  `Dnum` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `projeto`
--

INSERT INTO `projeto` (`Projnome`, `Projnumero`, `Projlocal`, `Dnum`) VALUES
('ProdutoX', 1, 'Santo André', 5),
('ProdutoY', 2, 'Itu', 5),
('ProdutoZ', 3, 'São Paulo', 5),
('Informatização', 10, 'Mauá', 4),
('Reorganização', 20, 'São Paulo', 1),
('Novos benefícios', 30, 'Mauá', 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `trabalha_em`
--

CREATE TABLE `trabalha_em` (
  `Fcpf` varchar(11) NOT NULL,
  `Pnr` int(11) NOT NULL,
  `Horas` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `trabalha_em`
--

INSERT INTO `trabalha_em` (`Fcpf`, `Pnr`, `Horas`) VALUES
('12345678966', 1, 32.50),
('12345678966', 2, 7.50),
('33344555587', 2, 10.00),
('33344555587', 3, 10.00),
('33344555587', 10, 10.00),
('33344555587', 20, 10.00),
('45345345376', 1, 20.00),
('45345345376', 2, 20.00),
('66688444476', 3, 40.00),
('88866555576', 20, NULL),
('98765432168', 20, 15.00),
('98765432168', 30, 20.00),
('98798798733', 10, 35.00),
('98798798733', 30, 5.00),
('99988777767', 10, 10.00),
('99988777767', 30, 30.00);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`Dnumero`),
  ADD KEY `Cpf_gerente` (`Cpf_gerente`);

--
-- Índices de tabela `dependente`
--
ALTER TABLE `dependente`
  ADD PRIMARY KEY (`Nome_dependente`,`Fcpf`),
  ADD KEY `Fcpf` (`Fcpf`);

--
-- Índices de tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`Cpf`),
  ADD KEY `Cpf_supervisor` (`Cpf_supervisor`),
  ADD KEY `Dnr` (`Dnr`);

--
-- Índices de tabela `localizacoes_dep`
--
ALTER TABLE `localizacoes_dep`
  ADD PRIMARY KEY (`Dnumero`,`Dlocal`);

--
-- Índices de tabela `projeto`
--
ALTER TABLE `projeto`
  ADD PRIMARY KEY (`Projnumero`),
  ADD KEY `Dnum` (`Dnum`);

--
-- Índices de tabela `trabalha_em`
--
ALTER TABLE `trabalha_em`
  ADD PRIMARY KEY (`Fcpf`,`Pnr`),
  ADD KEY `Pnr` (`Pnr`);

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `departamento_ibfk_1` FOREIGN KEY (`Cpf_gerente`) REFERENCES `funcionario` (`Cpf`);

--
-- Restrições para tabelas `dependente`
--
ALTER TABLE `dependente`
  ADD CONSTRAINT `dependente_ibfk_1` FOREIGN KEY (`Fcpf`) REFERENCES `funcionario` (`Cpf`);

--
-- Restrições para tabelas `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `funcionario_ibfk_1` FOREIGN KEY (`Cpf_supervisor`) REFERENCES `funcionario` (`Cpf`),
  ADD CONSTRAINT `funcionario_ibfk_2` FOREIGN KEY (`Dnr`) REFERENCES `departamento` (`Dnumero`);

--
-- Restrições para tabelas `localizacoes_dep`
--
ALTER TABLE `localizacoes_dep`
  ADD CONSTRAINT `localizacoes_dep_ibfk_1` FOREIGN KEY (`Dnumero`) REFERENCES `departamento` (`Dnumero`);

--
-- Restrições para tabelas `projeto`
--
ALTER TABLE `projeto`
  ADD CONSTRAINT `projeto_ibfk_1` FOREIGN KEY (`Dnum`) REFERENCES `departamento` (`Dnumero`);

--
-- Restrições para tabelas `trabalha_em`
--
ALTER TABLE `trabalha_em`
  ADD CONSTRAINT `trabalha_em_ibfk_1` FOREIGN KEY (`Fcpf`) REFERENCES `funcionario` (`Cpf`),
  ADD CONSTRAINT `trabalha_em_ibfk_2` FOREIGN KEY (`Pnr`) REFERENCES `projeto` (`Projnumero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
