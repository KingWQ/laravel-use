### 中间件
- 面向切面编程(AOP), 统一拦截请求、权限控制
- demo：记录程序的执行时间中间件
- 注册中间件，分为：全局中间件、路由中间件、控制器构造函数

### 数据库操作
`原生查询、查询构造器、ORM`
- value返回一行中的某个字段
- pluck返回某一列，数据是集合
- get多行是集合，first、find是对象
- where查询构造语句，打印出一条sql, 在后面加->dump()
- updateOrInsert 不存在就写入，存在更新
- 使用ORM，longtext为json, 指定cast指定存、取的时候是array。
- 使用ORM新增数据，create()返回模型对象、受模型约束，insert()返回布尔值没有通过模型。
- 使用ORM新增数据，先创建模型对象，在fill, 在save()。

### 集合的使用
- 获取所有的键或值：keys() values()
- 获取指定键对应的值，第二个参数指定生成集合的键：pluck()
- 获取特定的键值：only() except()
- 回调函数过滤，不传回调函数所有返回false元素被删除：filter()
- 第一个first(), 最后一个last(), 前面两个take(2)
- 集合元素拼接：implode()
- 判断是否有值contains(), 判断是否有键has()
- 判断集合是否为空：isEmpty()
- 集合循环：each() map()
- 指定键作为集合的键：keyBy()
- 根据指定键对集合项进行分组：groupBy()
- 集合的键和对应值进行互换：flip()
- 将一个集合的值作为键，与另一个集合后数组的值进行结合：combine()
- 笛卡尔集：crossJoin()

