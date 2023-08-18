# Kullanım Kılavuzu
## Expense Portal

Expense Portal, çalışanların ve managerlerin, adminlerin kullanabileceği küçük ölçekli bir yönetim uygulama örneğidir. Bu portal sayesinde çalışanlar harcama talepleri oluşturabilir ve görüntüleyebilirler. Yöneticiler ise çalışanlar tarafından oluşturulan harcama taleplerini onaylayabilir veya reddedebilirler. Aynı zamanda yöneticiler, yeni çalışanlar ve departmanlar ekleyebilir, çalışan bilgilerini güncelleyebilir veya silebilirler. Sistem yöneticisi (sys_admin) ise tüm bu yeteneklere ek olarak yönetici hesapları oluşturabilir ve yönetici bilgilerini güncelleyebilir.

## Kullanım:
Sys_admin kullanıcısıyla giriş yapın ve yönetici hesapları oluşturun.
Daha sonra oluşturduğunuz admin hesaplarıyla giriş yapın.

## Departman Oluşturma
Admin hesabınıza giriş yapın.
Ana panele gidin ve "Create Department" seçeneğini seçin.
Ya da Side-Bar'daki "Utilities" seçeceğini seçin ve açılan seçenekler arasından "Add Department" seçeneğini seçin.
Gerekli bilgileri doldurun ve "Create Department" düğmesine tıklayın.

## Görev Oluşturma
Admin hesabınıza giriş yapın.
Ana panele gidin ve "Create Designation" seçeneğini seçin.
Ya da Side-Bar'daki "Utilities" seçeceğini seçin ve açılan seçenekler arasından "Add Designation" seçeneğini seçin.
Gerekli bilgileri doldurun ve "Create Designation" düğmesine tıklayın.

## Para Birimi Oluşturma
Admin hesabınıza giriş yapın.
Ana panele gidin ve "Add Currency" seçeneğini seçin.
Ya da Side-Bar'daki "Utilities" seçeceğini seçin ve açılan seçenekler arasından "Add Currency" seçeneğini seçin.
Gerekli bilgileri doldurun ve "Create Currency" düğmesine tıklayın.

## Harcama Tipi Oluşturma
Admin hesabınıza giriş yapın.
Ana panele gidin ve "Create Designation" seçeneğini seçin.
Ya da Side-Bar'daki "Utilities" seçeceğini seçin ve açılan seçenekler arasından "Add Expense Type" seçeneğini seçin.
Gerekli bilgileri doldurun ve "Create Expense Type" düğmesine tıklayın.

## Personel Oluşturma
Admin hesabınıza giriş yapın.
Ana panele gidin ve Side-Bar'da bulunun components seçeneğine tıklayın.
Açılan seçenekler arasından "Create Employee" seçeneğini seçin.
Gerekli bilgileri doldurun ve "Create Employee" düğmesine tıklayın.

## Admin Oluşturma
Sysadmin olarak belirtilen yönetici hesabınıza giriş yapın.
Ana panele gidin ve Side-Bar'da bulunun components seçeneğine tıklayın.
Açılan seçenekler arasından "Admin Create" seçeneğini seçin.
Gerekli bilgileri doldurun ve "Create Admin" düğmesine tıklayın.

## Manager Atama
Admin hesabınıza giriş yapın.
Ana panele gidin ve ekrandaki çalışanlardan ilgili kiişiye gidip "Edit" butonuna tıklayın.
Gerekli bilgileri doldurun ve "is Manager" seçeneğini evet olarak seçin ve kaydedin.

## Harcama Raporu Oluşturma
Personel&Manager hesabınız giriş yapın.
Ana panele gidin ve "Create Expense Request" seçeneğini seçin.
Gerekli bilgileri doldurun ve "Submit Expense Request" düğmesine tıklayın.
Fatura eklemek için "Dosya Seç" düğmesine tıklayın ve dosyanızı yükleyin.

## Harcama Raporlarını Görüntüleme
Personel hesabınıza giriş yapın.
Ana panele gidin ve Side-Bar'daki "Tables" seçeneğine tıklayın.
Açılan seçenekler arasından "Expense Requests" seçeneğini seçin.

## Harcama Raporu Onaylama/Reddetme
Manager hesabınıza giriş yapın.
Ana panele gidin ve Side-Bar'daki "Tables" seçeneğine tıklayın.
Açılan seçenekler arasından "Expense Reports" seçeneğini seçin.
Gelen listeden ilgili harcamanın detayına gidin.
Harcamayı onaylayabilir veya reddedebilirsiniz.
Dilerseniz harcama raporunu "Create PDF Report" düğmesiyle indirebilirsiniz.

## Tüm Harcamaların Raporlarını Alma
Admin hesabınıza giriş yapın.
Ana panele gidin ve Side-Bar'daki "Tables" seçeneğine tıklayın.
Açılan seçenekler arasından "Expense Reports" seçeneğini seçin.
Ardından "Generate Expense Reports" butonuna tıklayın ve pdf raporu oluşturun.

# Portal Kullanım Detayları
Sys_admin hesabı bilgileri:
--- email : test@test.com
--- password : 123
- Bu bilgilerle sisteme giriş yapıp kullanım yapabilirsiniz.
- Email gönderim işlemi mailtrap.io sistemi tarafından yapılmaktadır.
- Sistem E-maili gerçek bir email olmak zorundadır.
- Kullanıcı email gönderimlerini test etmek istiyorsa kendi email test bilgilerini EmailController içerinde düzenlemelidir. (Şu anda sistemde Çağatay Duman'ın gmail adresi ile kayıt olduğu Mailtrap.io bilgileri bulunmaktadır.)

