use mis_db;
create table commodity_parents(
	id int primary key auto_increment,
    name varchar(45) unique not null,
    is_deleted bool not null,
    created_at datetime,
    updated_at datetime
);
create table commodities(
	id int primary key auto_increment,
    name varchar(45) unique not null,
    parent_id int not null,
    classification varchar(45) not null,
    count int not null,
    purchase_price double not null,
    retail_price double not null,
    recent_purchase_price double not null,
    recent_retail_price double not null,
    is_deleted bool not null,
    created_at datetime,
    updated_at datetime,
    foreign key (parent_id) references commodity_parents(id)
);
create table stocks(
	id int primary key auto_increment,
    created_at datetime,
    updated_at datetime
);
create table stock_items(
	id int primary key auto_increment, 
	stock_id int,
    commodity_id int not null,
    commodity_count int not null,
    created_at datetime,
    updated_at datetime,
    foreign key (commodity_id) references commodities(id),
	foreign key (stock_id) references stocks(id)
);
create table users(
	id int primary key auto_increment,
    name varchar(45) unique not null,
    password varchar(45) not null,
    email varchar(45) not null,
    position varchar(45) not null
);
create table receipts(
	id int primary key auto_increment,
    type int not null, -- 赠送、报溢、报损、报警 0 1 2 3
    is_approved bool not null,
    created_at datetime,
    updated_at datetime
);
create table receipt_items(
	id int primary key auto_increment,
    receipt_id int not null,
    commodity_id int not null,
    commodity_count int not null,
    created_at datetime,
    updated_at datetime,
    foreign key (receipt_id) references receipts(id),
    foreign key (commodity_id) references commodities(id)
);
create table customers(
	id int primary key auto_increment,
    is_saler bool not null,
    level int not null,
    name varchar(45) not null,
    telephone varchar(15),
    address varchar(115),
    zipcode varchar(45),
    email varchar(45),
    should_receive_quota double not null,
    should_receive double not null,
    should_pay double not null,
    created_at datetime,
    updated_at datetime
);
create table purchase_receipts(
	id int primary key auto_increment,
    daily_index int not null,
    supplier_id int not null,
    stock_id int not null,
    user_id int not null,
    comment varchar(45),
    sum double not null,
    created_at datetime,
    updated_at datetime,
    foreign key (supplier_id) references customers(id),
    foreign key (stock_id) references stocks(id),
	foreign key (user_id) references users(id)
);
create table purchase_receipt_items(
	id int primary key auto_increment, 
	purchasereceipt_id int not null,
    commodity_id int not null,
    commodity_count int not null,
    commodity_price double not null,
    commodity_sum double not null,
    created_at datetime,
    updated_at datetime,
    foreign key (purchasereceipt_id) references purchase_receipts(id),
    foreign key (commodity_id) references commodities(id)
);
create table purchase_back_receipts(
	id int primary key auto_increment,
    purchasereceipt_id int not null,
    commodity_id int,
    created_at datetime,
    updated_at datetime,
    foreign key (purchasereceipt_id) references purchase_receipts(id),
    foreign key (commodity_id) references commodities(id)
);
create table sale_receipts(
	id int primary key auto_increment,
    daily_index int not null,
    saler_id int not null,
    stock_id int not null,
    user_id int not null,
    sum double not null,
	discount double not null,
    coupon double not null,
    final_sum double not null,
    created_at datetime,
    updated_at datetime,
    comment varchar(45),
    foreign key (saler_id) references customers(id),
    foreign key (stock_id) references stocks(id),
    foreign key (user_id) references users(id)
);
create table sale_receipt_items(
	id int primary key auto_increment, 
	salereceipt_id int,
    commodity_id int,
    commodity_count int not null,
    commodity_price double not null,
    commodity_sum double not null,
    created_at datetime,
    updated_at datetime,
    foreign key (salereceipt_id) references sale_receipts(id),
    foreign key (commodity_id) references commodities(id)
);
create table sale_back_receipts(
	id int primary key auto_increment,
    salereceipt_id int not null,
    commodity_id int,
    created_at datetime,
    updated_at datetime,
    foreign key (salereceipt_id) references sale_receipts(id),
    foreign key (commodity_id) references commodities(id)
);
create table accounts(
	id int primary key auto_increment,
    name varchar(45) not null,
    sum double not null,
    attribute varchar(45),
    is_deleted bool not null,
    created_at datetime,
    updated_at datetime
);
create table receivables(
	id int primary key auto_increment,
    customer_id int,
    user_id int,
    sum double not null,
    created_at datetime,
    updated_at datetime,
    foreign key (customer_id) references customers(id),
    foreign key (user_id) references users(id)
);
create table receivables_items(
	id int primary key auto_increment,
    receivables_id int not null,
    account_id int not null,
    sum double not null,
    comment varchar(45),
    created_at datetime,
    updated_at datetime,
    foreign key (receivables_id) references receivables(id),
    foreign key (account_id) references accounts(id)
);
create table payments(
	id int primary key auto_increment,
    customer_id int,
    user_id int,
    sum double not null,
    created_at datetime,
    updated_at datetime,
    foreign key (customer_id) references customers(id),
    foreign key (user_id) references users(id)
);
create table payment_items(
	id int primary key auto_increment,
    payment_id int not null,
    account_id int not null,
    sum double not null,
    comment varchar(45),
    created_at datetime,
    updated_at datetime,
    foreign key (payment_id) references payments(id),
    foreign key (account_id) references accounts(id)
);
create table promotion_presents(
	id int primary key auto_increment,
    start_time datetime not null,
    duration_days int not null,
    created_at datetime,
    updated_at datetime
);
create table promotion_present_items(
	promotionpresent_id int not null,
    commodity_id int not null,
    commodity_count int not null,
    created_at datetime,
    updated_at datetime,
    foreign key (promotionpresent_id) references promotion_presents(id),
    foreign key (commodity_id) references commodities(id)
);
create table promotion_coupons(
	id int primary key auto_increment,
    reach_sum double not null,
	coupon_sum double not null,
    start_time datetime not null,
    duration_days int not null,
    created_at datetime,
    updated_at datetime
);
create table promotion_minuses(
	id int primary key auto_increment,
    reach_sum double not null,
	minus_sum double not null,
    start_time datetime not null,
    duration_days int not null,
    created_at datetime,
    updated_at datetime
);
create table promotion_combos(
	id int primary key auto_increment,
    minus_sum double not null,
    start_time datetime not null,
    duration_days int not null,
    created_at datetime,
    updated_at datetime
);
create table promotion_combo_items(
	id int primary key auto_increment,
    promotioncombo_id int not null,
    commodity_id int not null,
    commodity_count int not null,
    created_at datetime,
    updated_at datetime,
    foreign key (promotioncombo_id) references promotion_combos(id),
    foreign key (commodity_id) references commodities(id)
);
create table mis_commodities(
	id int primary key auto_increment, 
	commodity_id int not null,
    purchase_plan int not null, -- 0：减少进货；1：保持不变；2：增加进货
    sale_plan int not null, -- 0:设置赠送；1:保持不变；2:设置主推
    star int not null, -- 0, 1, 2, 3, 4
    foreign key (commodity_id) references commodities(id)
);



