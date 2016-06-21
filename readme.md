# InventoryMis project based on Laravel

Including system with basic functions and extended mis system, with which can user fetches the trends of business and makes correct decisions.

Functions of extended system are as following:

##商品计划：
	
	商品列表：
		显示商品、分类信息
		显示商品进货计划、销售计划、评分，可以进入查看
		显示商品趋势：进货、销售、利润的趋势（折线图）（按年月日的维度展示）
		
	商品比较：
		可以选择查看某个商品或某几个商品的折线图对比（按月的维度展示）
		商品可以显示折线图的属性：销售件数、总营业额、总利润额、利润占比
		总利润额：营业额 - 进货额；利润占比：进价 / 售价（以0.3作为基准）
		
	商品评分：
		属性：商品分类、商品名称、利润趋势、口碑
		利润趋势：按利润转换：评判是朝阳还是夕阳产业
		口碑：按退货：查看退货数量、退货与销售比例，停止对某些商品的进货
		
	分类走势：
		分类名称、分类利润月走势、分类下不同商品的占比情况（饼图）
		
	品牌走势：（可选）
		类型、查看该类型下不同商品的占比情况（饼图）

##进销计划：

	进货计划、销售计划
	
	添加进销计划（可选）

##客户计划：

	客户走势：
		通过客户（销售商）月消费额、平均消费
		确定是否需要维护（送券、折扣）
		推荐可能感兴趣的产品

	客户评级：
		计算客户的销售额，升星级
		计算客户的退货件数，降星级

	客户计划：
		显示所有客户计划

##经营计划：

	查看每个月的整体收／花，创建整体经营计划
	
	整体客户消费额走势，计算是否整体上升／下降，创建整体经营计划
	
	查看盈利情况，创建盈利目标

##员工计划：（可选）

	查看员工完成目标情况
