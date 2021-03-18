-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Mar-2021 às 19:45
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `auto_beauty_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `basket`
--

CREATE TABLE `basket` (
  `item_id` int(20) UNSIGNED NOT NULL,
  `client_id` varchar(45) NOT NULL,
  `rim_id` int(20) UNSIGNED NOT NULL,
  `quantity` int(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `basket`
--

INSERT INTO `basket` (`item_id`, `client_id`, `rim_id`, `quantity`) VALUES
(1, 'micael.2008@live.com.pt', 6, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `rims`
--

CREATE TABLE `rims` (
  `id` int(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(10) NOT NULL,
  `price` int(3) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `rims`
--

INSERT INTO `rims` (`id`, `image`, `name`, `price`, `reg_date`) VALUES
(1, 'jante_1.PNG', 'JR-1', 111, '2021-03-17 18:37:48'),
(2, 'jante_2.PNG', 'JR-2', 222, '2021-03-17 18:34:39'),
(3, 'jante_3.PNG', 'JR-3', 333, '2021-03-17 18:34:47'),
(4, 'jante_4.PNG', 'JR-4', 444, '2021-03-17 18:34:54'),
(5, 'jante_5.PNG', 'JR-5', 555, '2021-03-17 18:35:04'),
(6, 'jante_6.PNG', 'JR-6', 666, '2021-03-17 18:35:12'),
(7, 'jante_7.PNG', 'JR-7', 777, '2021-03-17 18:35:19'),
(8, 'jante_8.PNG', 'JR-8', 888, '2021-03-17 18:35:28'),
(9, 'jante_9.PNG', 'JR-9', 999, '2021-03-17 18:35:35'),
(10, 'jante_10.PNG', 'JR-10', 100, '2021-03-17 18:35:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `first_name` varchar(10) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `hash_value` varchar(32) NOT NULL,
  `user_activation_status` tinyint(1) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`, `is_admin`, `hash_value`, `user_activation_status`, `reg_date`) VALUES
('Micael', 'Machado', 'micael.2008@live.com.pt', '$2y$10$U.2d2WOnzTc3pLyU6AOGPupCQv1Vwf6LIHIRQ3X3EUUmP8y.QaS1C', 0, '0f28b5d49b3020afeecd95b4009adf4c', 1, '2021-03-17 18:39:40');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `client_FK` (`client_id`),
  ADD KEY `rim_FK` (`rim_id`);

--
-- Índices para tabela `rims`
--
ALTER TABLE `rims`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `basket`
--
ALTER TABLE `basket`
  MODIFY `item_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `rims`
--
ALTER TABLE `rims`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `client_FK` FOREIGN KEY (`client_id`) REFERENCES `users` (`email`),
  ADD CONSTRAINT `rim_FK` FOREIGN KEY (`rim_id`) REFERENCES `rims` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
