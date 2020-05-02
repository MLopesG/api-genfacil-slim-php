CREATE DATABASE genfro;

use genfro;

CREATE TABLE cidade (
  id_cidade int(11) NOT NULL,
  desc_cidade varchar(20) DEFAULT NULL,
  uf_cidade char(2) DEFAULT NULL
);

INSERT INTO cidade (id_cidade, desc_cidade, uf_cidade) VALUES
(1, 'Dourados', 'MS'),
(5, 'Campo-Grande', 'MS'),
(6, 'Ponta - Porã', 'MS'),
(7, 'Fatima do Sul', 'MS'),
(8, 'Glória de Dourados', 'MS'),
(9, 'Jatei', 'MS');

CREATE TABLE cliente (
  id_cliente int(11) NOT NULL,
  nome_cliente varchar(20) DEFAULT NULL,
  cpf_cliente char(11) DEFAULT NULL,
  endereco_cliente varchar(20) DEFAULT NULL,
  telefone_cliente char(11) DEFAULT NULL,
  email_cliente varchar(100) DEFAULT NULL
);

INSERT INTO cliente (id_cliente, nome_cliente, cpf_cliente, endereco_cliente, telefone_cliente, email_cliente) VALUES
(1, 'Matheus Lopes', '12345678910', 'Não sei', '98343255', 'matheuslopes5634@gmail.com');

CREATE TABLE contrato (
  id_contrato int(11) NOT NULL,
  data_contrato date DEFAULT NULL,
  valor_contrato double DEFAULT NULL,
  data_vencimento_contrato date DEFAULT NULL,
  id_veiculo int(11) DEFAULT NULL,
  id_cliente int(11) DEFAULT NULL,
  id_vendedor int(11) DEFAULT NULL,
  id_servico int(11) DEFAULT NULL,
  id_pacote int(11) DEFAULT NULL
);

INSERT INTO contrato (id_contrato, data_contrato, valor_contrato, data_vencimento_contrato, id_veiculo, id_cliente, id_vendedor, id_servico, id_pacote) VALUES
(4, '2020-05-01', 100, '2020-05-02', 19, 1, 2, 1, 1),
(5, '2020-05-01', 100, '2020-05-02', 19, 1, 2, 1, 1),
(6, '2020-05-01', 100, '2020-05-02', 19, 1, 2, 1, 1),
(7, '2020-05-01', 100, '2020-05-02', 19, 1, 2, 1, 1),
(8, '2020-05-01', 100, '2020-05-02', 19, 1, 2, 1, 1),
(9, '2020-05-01', 100, '2020-05-02', 19, 1, 2, 1, 1),
(10, '2020-05-01', 100, '2020-05-02', 19, 1, 2, 1, 1),
(11, '2020-05-01', 100, '2020-05-02', 19, 1, 2, 1, 1),
(12, '2020-05-01', 100, '2020-05-02', 19, 1, 2, 1, 1),
(13, '2020-05-01', 100, '2020-05-02', 19, 1, 2, 1, 1),
(14, '2020-05-01', 100, '2020-05-02', 19, 1, 2, 1, 1),
(15, '2020-05-01', 100, '2020-05-02', 19, 1, 2, 1, 1),
(16, '2020-05-01', 100, '2020-05-02', 19, 1, 2, 1, 1),
(17, '2020-05-01', 100, '2020-05-02', 19, 1, 2, 1, 1),
(18, '2020-05-01', 100, '2020-05-02', 19, 1, 2, 1, 1);

CREATE TABLE empresa (
  id_empresa int(11) NOT NULL,
  nome_empresa varchar(20) DEFAULT NULL,
  senha_empresa varchar(20) DEFAULT NULL,
  responsavel_empresa varchar(20) DEFAULT NULL,
  telefone_empresa char(11) DEFAULT NULL,
  email_empresa varchar(40) DEFAULT NULL,
  endereco_empresa varchar(40) DEFAULT NULL,
  cnpj_veiculo char(14) DEFAULT NULL,
  id_cidade int(11) DEFAULT NULL,
  logo_empresa text
);

INSERT INTO empresa (id_empresa, nome_empresa, senha_empresa, responsavel_empresa, telefone_empresa, email_empresa, endereco_empresa, cnpj_veiculo, id_cidade, logo_empresa) VALUES
(1, 'MTUR', '99510796', 'Marcos Lopes', '6798343255', 'Marcoslopes5687@gmail.com', 'Rua takão massago 1144', '01234566789', 7, 'https://valdetur.com.br/wp-content/uploads/2016/06/LOGO-Valdetur-1.png');

CREATE TABLE manuntencao (
  id_manuntencao int(11) NOT NULL,
  desc_manuntencao text,
  tipo_manuntencao varchar(100) DEFAULT NULL,
  valor_manuntencao int(11) DEFAULT NULL,
  data_manuntencao date DEFAULT NULL,
  id_veiculo int(11) DEFAULT NULL
);

INSERT INTO manuntencao (id_manuntencao, desc_manuntencao, tipo_manuntencao, valor_manuntencao, data_manuntencao, id_veiculo) VALUES
(6, 'Aqui descrição 2', 'Manuntenção', 100, '2019-02-02', 18),
(7, 'Aqui descrição', 'class=\"container\"class=\"container\"class=\"container\"class=\"container\"class=\"container\"class=\"containe', 100, '2019-02-02', 18);

CREATE TABLE pacote (
  id_pacote int(11) NOT NULL,
  nome_pacote varchar(20) DEFAULT NULL,
  cidade_pacote varchar(20) DEFAULT NULL,
  estado_pacote char(2) DEFAULT NULL,
  preço_pacote double DEFAULT NULL,
  parcelamento varchar(20) DEFAULT NULL,
  data_viagem date DEFAULT NULL
);

INSERT INTO pacote (id_pacote, nome_pacote, cidade_pacote, estado_pacote, preço_pacote, parcelamento, data_viagem) VALUES
(1, 'Pacote 1', 'Dourados', 'MS', 1200, '12x', '2020-05-02'),
(2, 'Pacote 1', 'Dourados', 'MS', 1200, '12x', '2020-05-02'),
(3, 'Pacote 1', 'Dourados', 'MS', 1200, '12x', '2020-05-02');

CREATE TABLE pagamento (
  id_pagamento int(11) NOT NULL,
  data_pagamento date DEFAULT NULL,
  id_contrato int(11) DEFAULT NULL
);

INSERT INTO pagamento (id_pagamento, data_pagamento, id_contrato) VALUES
(1, '0000-00-00', NULL),
(2, '0000-00-00', NULL),
(3, '0000-00-00', 16),
(4, '0000-00-00', 17),
(5, '2020-05-02', 18);

CREATE TABLE servico (
  id_servico int(11) NOT NULL,
  tipo_servico varchar(20) DEFAULT NULL,
  km_percorrido int(11) DEFAULT NULL,
  data_ida date DEFAULT NULL,
  data_volta date DEFAULT NULL,
  cidade_servico_destino varchar(40) DEFAULT NULL,
  cidade_servico_origem varchar(40) DEFAULT NULL
);

INSERT INTO servico (id_servico, tipo_servico, km_percorrido, data_ida, data_volta, cidade_servico_destino, cidade_servico_origem) VALUES
(1, 'Fretamento', 1200, '2018-06-06', '2018-06-06', 'Campo-Grande', 'Dourados'),
(2, 'Fretamento', 1200, '2018-06-06', '2018-06-06', 'Dourados', 'Dourados'),
(3, 'Viagem Interestadual', 0, '2018-06-27', '2018-02-27', 'Dourados', 'Dourados'),
(4, 'Viagem Interestadual', 100, '2020-12-31', '2020-12-31', 'Dourados', 'Campo Grande'),
(5, 'Viagem Intermunicipa', 100, '2020-12-31', '2020-12-31', 'Dourados', 'Campo Grande');

CREATE TABLE tipo_veicullo (
  id_tipo_veiculo int(11) NOT NULL,
  desc_tipo_veiculo varchar(40) DEFAULT NULL
);

INSERT INTO tipo_veicullo (id_tipo_veiculo, desc_tipo_veiculo) VALUES
(1, 'ônibus'),
(2, 'Vans'),
(3, 'Carros'),
(4, 'Motos'),
(5, 'Caminhões');

CREATE TABLE veiculo (
  id_veiculo int(11) NOT NULL,
  nome_veiculo varchar(40) DEFAULT NULL,
  capacidade_veiculo int(11) DEFAULT NULL,
  img_veiculo text,
  ano_veiculo int(11) DEFAULT NULL,
  marca_veiculo varchar(20) DEFAULT NULL,
  id_tipo_veiculo int(11) DEFAULT NULL,
  id_empresa int(11) DEFAULT NULL
);

INSERT INTO veiculo (id_veiculo, nome_veiculo, capacidade_veiculo, img_veiculo, ano_veiculo, marca_veiculo, id_tipo_veiculo, id_empresa) VALUES
(18, 'Neobus N10', 52, 'http://conteudo.imguol.com.br/c/noticias/2013/12/13/a-cometa-vai-operar-4-onibus-batizados-de-flecha-de-ouro-lxv-com-a-pintura-e-o-interior-inspirados-no-classico-flecha-azul-a-iniciativa-atende-a-pedidos-e-sugestoes-de-clientes-passageiros-e-1386964432517_615x300.jpg', 2018, 'Neobus', 1, 1),
(19, 'Cometa Flecha Azul', 42, 'https://1.bp.blogspot.com/-U4hthK8bePM/Wt_GQDJq35I/AAAAAAAA_3U/3bpx3esLdsUYNbV2kNz-GPGTrYVxK8T_ACLcBGAs/s1600/cometa7455-6.jpg', 1998, 'CMA', 1, 1),
(20, 'Cometa Flecha Azul', 42, 'https://1.bp.blogspot.com/-U4hthK8bePM/Wt_GQDJq35I/AAAAAAAA_3U/3bpx3esLdsUYNbV2kNz-GPGTrYVxK8T_ACLcBGAs/s1600/cometa7455-6.jpg', 1998, 'CMA', 1, 1),
(21, 'Cometa Flecha Azul', 42, 'https://1.bp.blogspot.com/-U4hthK8bePM/Wt_GQDJq35I/AAAAAAAA_3U/3bpx3esLdsUYNbV2kNz-GPGTrYVxK8T_ACLcBGAs/s1600/cometa7455-6.jpg', 1998, 'CMA', 1, 1),
(22, 'Cometa Flecha Azul', 42, 'https://1.bp.blogspot.com/-U4hthK8bePM/Wt_GQDJq35I/AAAAAAAA_3U/3bpx3esLdsUYNbV2kNz-GPGTrYVxK8T_ACLcBGAs/s1600/cometa7455-6.jpg', 1998, 'CMA', 1, 1),
(23, 'Cometa Flecha Azul', 42, 'https://1.bp.blogspot.com/-U4hthK8bePM/Wt_GQDJq35I/AAAAAAAA_3U/3bpx3esLdsUYNbV2kNz-GPGTrYVxK8T_ACLcBGAs/s1600/cometa7455-6.jpg', 1998, 'CMA', 1, 1);

CREATE TABLE vendedor (
  id_vendedor int(11) NOT NULL,
  nome_vendedor varchar(20) DEFAULT NULL,
  fone_vendedor char(11) DEFAULT NULL,
  email_vendedor varchar(100) DEFAULT NULL
);

INSERT INTO vendedor (id_vendedor, nome_vendedor, fone_vendedor, email_vendedor) VALUES
(2, 'josecarlos', '98343255', 'josecarlos5634@gmail.com');


ALTER TABLE cidade
  ADD PRIMARY KEY (id_cidade);

ALTER TABLE cliente
  ADD PRIMARY KEY (id_cliente);

ALTER TABLE contrato
  ADD PRIMARY KEY (id_contrato),
  ADD KEY id_cliente (id_cliente),
  ADD KEY id_veiculo (id_veiculo),
  ADD KEY id_vendedor (id_vendedor),
  ADD KEY id_servico (id_servico);

ALTER TABLE empresa
  ADD PRIMARY KEY (id_empresa),
  ADD KEY id_cidade (id_cidade);

ALTER TABLE manuntencao
  ADD PRIMARY KEY (id_manuntencao),
  ADD KEY id_veiculo (id_veiculo);

ALTER TABLE pacote
  ADD PRIMARY KEY (id_pacote);

ALTER TABLE pagamento
  ADD PRIMARY KEY (id_pagamento),
  ADD KEY id_contrato (id_contrato);

ALTER TABLE servico
  ADD PRIMARY KEY (id_servico);

ALTER TABLE tipo_veicullo
  ADD PRIMARY KEY (id_tipo_veiculo);

ALTER TABLE veiculo
  ADD PRIMARY KEY (id_veiculo),
  ADD KEY id_tipo_veiculo (id_tipo_veiculo),
  ADD KEY id_empresa (id_empresa);

ALTER TABLE vendedor
  ADD PRIMARY KEY (id_vendedor);


ALTER TABLE cidade
  MODIFY id_cidade int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE cliente
  MODIFY id_cliente int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE contrato
  MODIFY id_contrato int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

ALTER TABLE empresa
  MODIFY id_empresa int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE manuntencao
  MODIFY id_manuntencao int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

ALTER TABLE pacote
  MODIFY id_pacote int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE pagamento
  MODIFY id_pagamento int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE servico
  MODIFY id_servico int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE tipo_veicullo
  MODIFY id_tipo_veiculo int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE veiculo
  MODIFY id_veiculo int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

ALTER TABLE vendedor
  MODIFY id_vendedor int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE contrato
  ADD CONSTRAINT contrato_ibfk_1 FOREIGN KEY (id_cliente) REFERENCES `cliente` (id_cliente) ON DELETE CASCADE
 ON UPDATE CASCADE,
  ADD CONSTRAINT contrato_ibfk_2 FOREIGN KEY (id_veiculo) REFERENCES veiculo (id_veiculo) ON DELETE CASCADE
 ON UPDATE CASCADE,
  ADD CONSTRAINT contrato_ibfk_3 FOREIGN KEY (id_vendedor) REFERENCES vendedor (id_vendedor) ON DELETE CASCADE
 ON UPDATE CASCADE,
  ADD CONSTRAINT contrato_ibfk_4 FOREIGN KEY (id_servico) REFERENCES servico (id_servico) ON DELETE CASCADE
 ON UPDATE CASCADE;

ALTER TABLE empresa
  ADD CONSTRAINT empresa_ibfk_1 FOREIGN KEY (id_cidade) REFERENCES cidade (id_cidade) ON DELETE CASCADE
 ON UPDATE CASCADE;

ALTER TABLE manuntencao
  ADD CONSTRAINT manuntencao_ibfk_1 FOREIGN KEY (id_veiculo) REFERENCES veiculo (id_veiculo) ON DELETE CASCADE
 ON UPDATE CASCADE;

ALTER TABLE pagamento
  ADD CONSTRAINT pagamento_ibfk_1 FOREIGN KEY (id_contrato) REFERENCES contrato (id_contrato) ON DELETE CASCADE
 ON UPDATE CASCADE;

ALTER TABLE veiculo
  ADD CONSTRAINT veiculo_ibfk_1 FOREIGN KEY (id_tipo_veiculo) REFERENCES tipo_veicullo (id_tipo_veiculo) ON DELETE CASCADE
 ON UPDATE CASCADE,
  ADD CONSTRAINT veiculo_ibfk_2 FOREIGN KEY (id_empresa) REFERENCES empresa (id_empresa) ON DELETE CASCADE
 ON UPDATE CASCADE;
