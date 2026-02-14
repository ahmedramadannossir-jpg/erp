# Click Store Installment Management (Laravel)

نظام ويب لإدارة العملاء، عقود التقسيط، الأقساط، الأرباح، وصفحة عامة لكل عميل عبر رابط `unique_code` بدون تسجيل دخول.

## الميزات المنفذة
- CRUD للعملاء مع توليد `unique_code` تلقائي.
- إنشاء عقد تقسيط مع:
  - ربط العميل.
  - الربح بنظام `percent` أو `fixed`.
  - احتساب `total_after_profit` و `installment_value` تلقائيًا.
  - تحديد أول قسط `auto` أو `manual`.
- توليد جدول الأقساط تلقائيًا بعد حفظ العقد.
- تحديث القسط إلى `paid` من لوحة الإدارة.
- أمر مجدول لتغيير الأقساط المتأخرة إلى `late` يوميًا.
- Dashboard بإحصائيات أساسية.
- صفحة عامة للعميل تعرض المتبقي وجدول الأقساط + QR.

## أوامر التشغيل
```bash
composer install
php artisan migrate
php artisan serve
php artisan schedule:work
```

## المسارات
- `/` لوحة التحكم
- `/clients` العملاء
- `/contracts` العقود
- `/u/{token}` صفحة العميل العامة
