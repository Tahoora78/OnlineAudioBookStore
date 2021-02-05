-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2021 at 05:11 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `thumbnail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `description`, `thumbnail`) VALUES
(1, 'کتاب صوتی چیست؟', '<p>کتاب صوتی متن کتابی است که توسط یک یا چند گوینده خوانده می&zwnj;شود و بصورت فایل صوتی درمی آید. معمولا کسانی که اختلال بینایی دارند و یا سالمندان از کتاب صوتی استفاده می کنند. آسمونی در این بخش اطلاعات کامل و جامعی در مورد کتاب صوتی که به آن گتاب گویا هم گفته می شود، برای شما عزیزان تهیه کرده است.</p>\r\n\r\n<p>پیشینه کتاب گویا در جهان به سال 1932 برمی&zwnj;گردد که در آن سال گنگره آمریکا، برنامه کتاب سخنگو را در دستور کار قرار داد. این پروژه که &laquo;کتاب برای نابینایان&raquo; نام داشت، در ابتدا در راستای کمک به نابینایان برای مطالعه صورت گرفت. بنیاد نابینایان اولین بار کتاب سخنگو را در سال 1932 تولید کرد و سال بعد برای اولین بار تولید انبوه کتاب سخنگو آغاز گشت.</p>\r\n\r\n<p>در سال 1933 جی. پی هارینگتون که در رشته مردم&zwnj;شناسی کار می&zwnj;کرد، آمریکای شمالی را درنوردید تا تاریخ قبایل بومی آمریکایی را روی دیسک&zwnj;های آلومینیومی با استفاده از گرامافونی که با برق اتومبیل کار می&zwnj;کرد ضبط کند. کتاب سخنگو سنت قصه&zwnj;گویی را که هارینگتون سال&zwnj;ها پیش تحقیقاتی درباره آن انجام داده بود، زنده می&zwnj;کرد. تا سال 1935 که پس از آن کنگره تصویب کرد کتاب&zwnj;های سخنگو برای شهروندان نابینا به رایگان ارسال شود، پروژه &laquo;کتاب برای نابینایان بزرگسال&raquo; به طور جدی دنبال می&zwnj;شد.</p>\r\n\r\n<p>ابتدا برخی از کتاب&zwnj;های آموزشی و درسی روی کاست پیاده شد و به دنبال آن کتاب&zwnj;های ادبی و داستان و حکایات ارائه شدند. در سال 1970 شرکت کتاب گویا شروع به اجرای طرح اجاره کتاب صوتی کرد و خدمات فروش محصولات خود را به کتابخانه&zwnj;ها توسعه داد. به این ترتیب کتاب گویا هر چه بیشتر جایگاه خود را میان مردم باز کرد و طرفداران بسیاری یافت. در اواسط دهه 1980 نشر کتاب گویا، فعالیتی با گردش مالی بالغ بر چندین میلیارد دلار در سال بود.</p>\r\n\r\n<p>با پدید آمدن سی&zwnj;دی، طرفداران آثار صوتی بیشتر شد. با توسعه اینترنت، تکنولوژی&zwnj;های ارتباطی، فرمت&zwnj;های جدید فشرده صوتی و دستگاه&zwnj;های پخش صوتی MP3 که به راحتی قابل حمل هستند، محبوبیت کتاب&zwnj;های سخنگو به شکل شگفت&zwnj;انگیزی رو به افزایش گذارد. این رشد با دسترسی به خدمات دانلود کتاب&zwnj;های گویا شدت یافت.</p>\r\n\r\n<p>همگانی شدن دستگاه&zwnj;های پخش موسیقی مانند آی&zwnj;پودها نیز کتاب&zwnj;های سخنگو را برای عموم افراد قابل دسترس&zwnj;تر ساخت.</p>\r\n\r\n<p>امروزه صنعت نشر کتاب سخنگو در دنیا، صنعتی بزرگ با گردش مالی قابل توجه است که توجه شایسته به آن می&zwnj;تواند برای ارتقاء فرهنگ مطالعه کتاب و همچنین تلفیق دنیای نشر سنتی با امکانات و الزامات نشر روز و بهره مندی از آن در کشور ما نیز مفید باشد.</p>\r\n\r\n<p><img alt=\"کتاب صوتی\" src=\"https://files.virgool.io/upload/users/29872/posts/suvptomk95ds/m2vywcpi0knp.jpeg\" /></p>\r\n\r\n<p>کتاب صوتی</p>\r\n\r\n<h4><strong>مزایای استفاده از کتاب سخنگو:</strong></h4>\r\n\r\n<p>استفاده از کتاب سخنگو مزایای بسیاری دارد. در ادامه این بحث به طور خلاصه به بعضی از این مزایا اشاره می&zwnj;شود:</p>\r\n\r\n<p>استفاده بهینه از زمان&zwnj;های غیر کارآمد و امکان انجام همزمان کارها:</p>\r\n\r\n<p>گوش دادن به کتاب سخنگو لذت بخش است، اما برتر از آن این که می&zwnj;توان با استفاده از آن زمان&zwnj;هایی را که به طور عادی از دست رفته محسوب می&zwnj;شوند، به بهترین زمان برای مطالعه تبدیل کرد. افرادی که در طول روز زمان زیادی را صرف رفت و آمد به محل کار خود می&zwnj;کنند، از طرفداران پر و پا قرص کتاب سخنگو هستند. گوش کردن به کتاب سخنگو به آنها کمک می&zwnj;کند در طول مسیر کمتر استرس داشته باشند و زمان برایشان سریع&zwnj;تر بگذرد و از همه مهم&zwnj;تر این که کتاب&zwnj;های دلخواه خود را نیز مطالعه کرده باشند. بر اساس تحقیقات اخیر هر شهروند آمریکایی برای رفتن به سر کار و برگشتن از آن، حدود یک ساعت و سیزده دقیقه وقت صرف می&zwnj;کند که معادل چهارصد و چهل ساعت یا یازده هفته کاری در سال می&zwnj;شود. در صورتی که از همین زمان برای گوش دادن به کتاب گویا استفاده شود، کتابهای بسیاری در طول سال به همین سادگی مطالعه خواهد شد. به طور یقین زمانهای از دست رفته برای مردم ما بیشتر از اینهاست.</p>\r\n\r\n<p>اگر خواندن را دوست دارید، اما آن قدر مشغول کارهای دیگر هستید که به کتاب خواندن نمی&zwnj;رسید، گوش کردن به کتابهای گویا راهی ویژه و فوق&zwnj;العاده برای پر کردن بسیاری از زمانهای غیر مولد است که عموماً همه ما در طول روز چند ساعتی از آن را داریم. هنگام ورزش، انجام کارهای شخصی، نظافت و &hellip; از جمله این زمانهاست.</p>\r\n\r\n<h4><strong>آموزش:</strong></h4>\r\n\r\n<p>کتاب سخنگو برای اهداف آموزشی نیز مورد استفاده قرار می&zwnj;گیرد و ابزاری ارزشمند برای یادگیری محسوب می&zwnj;شود. با کتاب سخنگو برخلاف کتاب سنتی، فرد می&zwnj;تواند هنگام انجام کارهای دیگر نیز به یادگیری بپردازد. کارهایی که نیاز به فکر و توجه چندانی ندارند، همزمان با گوش کردن به کتاب سخنگو و یادگیری امکان پذیر هستند.</p>\r\n\r\n<h4><strong>سالمندان، بیماران و ناتوانان و معلولین:</strong></h4>\r\n\r\n<p>کتاب گویا برای این دسته از افراد فوق&zwnj;العاده است. افرادی که به هر دلیلی از فعالیتهای معمول محروم هستند، با گوش دادن به کتاب سخنگو، می&zwnj;توانند بخش زیادی از اوقات خود را به بهترین شکل پر کنند و از آن لذت ببرند.</p>\r\n\r\n<h4><strong>افرادی که اختلال بینایی دارند:</strong></h4>\r\n\r\n<p>کتاب گویا برای نابینایان و کسانی که اختلال بینایی دارند، یک موهبت محسوب می&zwnj;شود. کتاب گویا به آنها این امکان را می&zwnj;دهد تا از انواع کتاب&zwnj;های مورد علاقه&zwnj;شان بهره&zwnj;مند شوند. کتاب&zwnj;های گویا می&zwnj;تواند به این افراد کمک کند تا دانش و معلومات خود را افزایش دهند، و زندگی&zwnj;شان را از جهت شخصی و حرفه&zwnj;ای غنی&zwnj;تر کنند.</p>\r\n', '1612446096_9d3b2a41650e88eaf1f0.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(100) NOT NULL,
  `publishers` varchar(255) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `audio` varchar(255) NOT NULL,
  `time` int(11) NOT NULL DEFAULT 0,
  `views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `id_users`, `title`, `description`, `price`, `publishers`, `cover`, `audio`, `time`, `views`) VALUES
(7, 23, 'من او را دوست داشتم', '<p dir=\"RTL\" style=\"text-align:justify\">زندگی پر از تضادهایی است که گاهی آنقدر بزرگ هستند که انسان را سر دوراهی قرار می&zwnj;دهد. آنا گاوالدا نویسنده&zwnj;ی معاصر فرانسوی در رمان من او را دوست داشتم یک قصه&zwnj;ی عاشقانه را روایت می&zwnj;کند. قصه&zwnj;ای که خواننده را با تضادی بزرگ بین ماندن و رفتن مواجه می&zwnj;کند. قصه&zwnj;ی خیانت قصه&zwnj;ی دیروز و امروز نیست. قصه&zwnj;ای است که در تاریخ همواره بوده و زندگی زنان و مردان زیادی را تحت تاثیر قرار داده است و شخصیت&zwnj;های این داستان نیز گریبان گیر این موضوع شده&zwnj;اند.</p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><img alt=\"\" src=\"https://cdn.fidibo.com/images/content/images/%D9%85%D9%86_%D8%A7%D9%88_%D8%B1%D8%A7_%D8%AF%D9%88%D8%B3%D8%AA_%D8%AF%D8%A7%D8%B4%D8%AA%D9%85.jpg\" /></p>\r\n\r\n<h2 dir=\"RTL\" style=\"text-align:justify\">خلاصه داستان من او را دوست داشتم</h2>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\">کلوئه زنی فرانسوی ست که عاشق زندگی، همسر خود آدرین و دو فرزندشان است؛ اما بعد از سال&zwnj;ها آدرین دلباخته زن دیگری می&zwnj;شود و کلوئه را ترک می&zwnj;کند. زندگی کلوئه از این زمان دچار تغییرات زیادی می&zwnj;شود. او تصمیم می&zwnj;گیرد پاریس را ترک کند و به خانه پدر و مادر همسرش می&zwnj;رود؛ اما در ادامه زندگی با آن دو نفر هم ماجراهای جدیدی را برای کلوئه رقم میزند.</p>\r\n\r\n<h2 dir=\"RTL\" style=\"text-align:justify\">درباره کتاب صوتی من او را دوست داشتم</h2>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"background-color:white\">کتاب من او را دوست داشتم اولین رمان نویسنده محبوب فرانسوی آنا گاوالداست. این کتاب رمانی کوتاه، احساسی و عاشقانه است که اولین بار در سال 2002 منتشر شد. داستان اصلی این ک تاب حول اتفاق مهمی است که برای شخصیت اصلی داستان یعنی کلوئه می&zwnj;افتد. کلوئه زنی است که در روزگار ما زندگی می&zwnj;کند و با خیانت همسرش مواجه می&zwnj;شود. موضوعی که می&zwnj;توان گفت همچنان در جامعه در حال رخ دادن است.</span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"background-color:white\">در ادامه&zwnj;ی داستان می&zwnj;بینیم که کلوئه همراه فرزندانش به خانه پدر همسرش می&zwnj;رود. داستان از این قسمت وارد ماجراهایی می&zwnj;شود که کلوئه و پدرشوهرش وارد آن می&zwnj;شوند. در حقیقت فضاسازی و شخصیت&zwnj;پردازی گاوالدا در بستر موضوعی که دامن&zwnj;گیر جوامع امروز است باعث شده تا این اثر نه&zwnj;تنها برای زنان که برای مردان هم خواندنی و تاثیرگذار باشد.</span> آنا گاوالدا توجه ویژه&zwnj;ای به آدم&zwnj;های پیرامون خودش دارد. او به خوبی از پس روایت درونیات و حال افراد بر می&zwnj;آید؛ اما به تصویر کشیدن افراد شکست خورده و تباه شده در جامعه چه در جایگاه ثروتمند و چه فقیر ویژگی منحصر به فرد داستان&zwnj;های اوست. <span style=\"background-color:white\">جملات گاوالدا ساده و دلنشین هستند. او روان و احساسی می&zwnj;نویسد. </span>خودش می&zwnj;گوید &laquo;به جمله&zwnj;های روان و سلیس بسیار علاقه&zwnj;مندم، به این که هیچ&zwnj;چیز مانع روانی نوشته نشود [...] می&zwnj;خوانم، دوباره می&zwnj;خوانم، اضافه می&zwnj;کنم، کم می&zwnj;کنم تا متن آشوب برانگیز شود. وسواس عجیبی به این کار دارم.&raquo;</p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\">من او را دوست داشتم دو راوی دارد. در بخش اول کلوئه راوی قصه است و در بخش دوم پدر شوهرش راوی <span style=\"background-color:white\">است که سعی دارد با حرف&zwnj;هایش کلوئه و دو نوه&zwnj;اش را به زندگی امیدوار کند</span>. کتاب صوتی من او را دوست داشتم از آن دست کتاب&zwnj;های صوتی است که جملات قصار زیبا دارد و می&zwnj;توان قبل خواب، هنگام رانندگی یا زمان&zwnj;هایی که در ترافیک می&zwnj;گذرد گوش داد. خوانش این کتاب را بهناز جعفری بازیگر سینما و تلوزیون با دقت و مطابق با لحن داستان روایت کرده است. به همین دلیل این اثر شنیدنی مخاطب خود را تا پایان داستان همراه می&zwnj;کند.</p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\">نسخه چاپی این کتاب را انتشارات قطره با ترجمه&zwnj;ی الهام دارچینیان منتشر کرده است و انتشارات نوین کتاب گویا با همکاری این ناشر آن را در دسترس علاقه&zwnj;مندان قرار داده است.</p>\r\n\r\n<h2 dir=\"RTL\" style=\"text-align:justify\">درباره آناگاوالدا نویسنده کتاب صوتی من او را دوست داشتم</h2>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"background-color:white\">آنا گاوالدا&nbsp;رمان&zwnj;نویس مشهور قرن بیستم میلادی و اهل فرانسه است. او زندگی پر فراز و نشیبی داشته است. زمانی که کودک بود پدر و مادرش از هم جدا شدند و آنا زندگی متفاوتی را در دوره نوجوانی و جوانی تجربه کرد. گاوالدا در دوران دانشجویی خود شغل&zwnj;های مختلفی را امتحان کرد. این موضوع باعث شد تا او تجربیات مفیدی پیدا کند و از آن&zwnj;ها در روایت داستان&zwnj;هایش استفاده کند. گاوالدا مدتی را هم به عنوان گل&zwnj;فروش کار می&zwnj;کرده است.</span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"background-color:white\">او در جوانی با یک دامپزشک ازدواج کرد و از او صاحب دو فرزند شد؛ اما چند سال بعد از همسرش جدا شد؛ و تمام وقت خود را صرف ادبیات کرد. کتاب&zwnj;های او در این زمان به اوج شهرت رسیدند و گاوالدا توانست جوایز متعدد ادبی را دریافت کند. داستان&zwnj;های او بیشتر حول محور عشق و احساسات آدمی در روابط است. او اولین مجموعه داستان خود را با نام &laquo;دوست داشتم کسی جایی منتظرم باشد&raquo; منتشر کرد. این کتاب به ۱۹ زبان دنیا ترجمه شد و یکی از پرفروش&zwnj;ترین کتاب&zwnj;های فرانسه لقب گرفت. آناگاوالدا هیچگاه از محبوبیت و شهرتی که به دست آورد سو استفاده نکرد. کتاب &laquo;دوست داشتم کسی جایی منتظرم باشد&raquo; در ۲۷ کشور منتشر شد و به فروش رسید.</span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"background-color:white\">&nbsp;<span style=\"background-color:white\">در سال </span><span style=\"background-color:white\">۲۰۰۹</span><span style=\"background-color:white\"> فیلمی از کتاب&nbsp; &laquo;من او را دوست داشتم&raquo; با همین عنوان توسط &laquo;زابو بریت&zwnj;مَن&raquo; در کشور فرانسه تولید شد</span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n', '28000', 'نوین کتاب', '1612364307_d710ad24ff35c34f1d1e.jpg', '1612364307_b0dc03afbfa3bdec7472.mp3', 4, 85),
(8, 23, 'یک عاشقانه آرام', '<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\">&laquo;<strong>نادر ابراهیمی</strong>&raquo; می&zwnj;نویسد: عاشق، بهانه نمی&zwnj;&zwnj;گیرد. عاشق، نق نمی&zwnj;زند. عاشق، در باب زندگی، سخت نمی&zwnj;گیرد. تخم&zwnj;مرغ تازه&zwnj;ی پخته، عطر ماندگاری دارد. عاشق، به نان خالی و ظرف پر از محبت راضی است.</span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\"><img alt=\"کتاب گویا یک عاشقانه آرام نوشته نادر ابراهیمی\" src=\"https://cdn.fidibo.com/images/content/images/yek_asheghane_arambook.jpg.jpg\" /></span></p>\r\n\r\n<h2 dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\"><strong>درباره کتاب صوتی یک عاشقانه آرام</strong></span></h2>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\">کتاب &laquo;یک عاشقانه آرام&raquo; نوشته&zwnj;ی &laquo;نادر ابراهیمی&raquo; روایتی لطیف و عاشقانه میان یک زوج است که متن آن مملو از ترکیبات و جملات زیبا است. مرد این داستان گیله&zwnj;مردی معلم&zwnj; است که در سفر به منطقه&zwnj;ی آذربایجان دل&zwnj;بسته&zwnj;ی دختری زیبا و دل&zwnj;نشین به نام عسل می&zwnj;شود. آن&zwnj;ها ازنظر اجتماعی و سیاسی تفکرات نزدیک به یکدیگر دارند و عشق&zwnj; و رابطه&zwnj;شان موضوع اصلی این داستان است. &laquo;نادر ابراهیمی&raquo; با قلم توانایش گفتگوهای میان این دو نفر را با دقت و زیبایی شکل داده است که بر دل و روح بسیار می&zwnj;نشیند. نثر این اثر در قسمت&zwnj;هایی شاعرانه است . از این نظر نسبت به سایر آثار عاشقانه ارجحیت دارد. گیله&zwnj;مرد این داستان با حضور عسل در زندگی&zwnj;اش جملات ماندگار و بسیار زیبایی بیان می&zwnj;کند گویی عشق واقعی در حال به وقوع پیوستن است. او عسل را بارها در این داستان خطاب قرار می&zwnj;دهد: &laquo;عسل، بگو! چون که ما جز گفتن، هیچ&zwnj;چیز نیستیم. عشق، نوعی گفتن است و عالی&zwnj;ترین نوع گفتن. جنگ هم گفتن است. ایمان هم گفتن است. نگاه کردن، یک واژه&zwnj;ی نرم است... عسل! بگذار سر بر زانویت بگذارم و تو به زمزمه، از نخستین سفر گیله&zwnj;مرد کوچکت به ساوالان بگو... مگذار که عشق ، به عادتِ دوست داشتن تبدیل شود!&raquo; </span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\">کتاب &laquo;یک عاشقانه آرام&raquo; یکی از آثار پرفروش این نویسنده است که تا امروز بیش از بیست بار تجدید چاپ شده است. نسخه&zwnj;ی صوتی &laquo;یک عاشقانه آرام&raquo; را ناشر صوتی نوین کتاب گویا با صدای &laquo;پيام دهكردي&raquo; و موسیقی &laquo;کریستف رضاعی&raquo; منتشر کرده است که در همین صفحه از فیدیبو برای خرید و دانلود موجود است. این نسخه&zwnj;ی صوتی شامل 53 بخش است که میانگین آن&zwnj;ها حدود ده دقیقه است. نسخه&zwnj;ی الکترونیک این اثر هم از سوی انتشارات روزبهان در اختیار سایت و اپلیکیشن فیدیبو است. </span></p>\r\n\r\n<h2 dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\"><strong>درباره نادر ابراهیمی</strong></span></h2>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\">&laquo;نادرابراهیمی&raquo; نویسنده و داستان&zwnj;نویس برجسته&zwnj;ی ایرانی در تاریخ 14 فروردین سال 1315 در تهران به دنیا آمد. خانواده&zwnj;ی او از حاکمان کرمان در دوران قاجار بودند که به مشکین&zwnj;شهر تبعید شدند. او در نوجوانی به دبیرستان دارالفنون رفت و پس از آن تحصیل در رشته&zwnj;ی حقوق را آغاز کرد که آن را ناتمام رها کرد. او تحصیل در رشته&zwnj;ی زبان و ادبیات انگلیسی را فرا گرفت که با روحیاتش سازگار بود و به آن علاقه داشت. او در طی این سال&zwnj;ها به فعالیت&zwnj;های اجتماعی و سیاسی مشغول بود و چندین بار هم به زندان افتاد. </span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\">&laquo;نادر ابراهیمی&raquo; فردی جسور و بلندپرواز بود و زندگی پرماجرایی داشت. او در بانک، چاپخانه، روزنامه، تعمیرگاه مشغول به کار شد و شرح&zwnj;حال شیرین و خواندنی از این دورانش را در دو کتاب &laquo;ابن مشغله&raquo; و &laquo;ابوالمشاغل&raquo; بازگو کرده است. او یکی از پرکارترین نویسنده&zwnj;های ایرانی است که از خودش مقاله، کتاب، داستان و نقد ادبی به&zwnj;جا گذاشته است. او اولین اثرش را سال 1342 منتشر کرد و پس از آن به&zwnj;طور حرفه&zwnj;ای نویسندگی را از سر گرفت. او در حوزه&zwnj;ی ادبیات کودک و نوجوان هم بسیار فعال بود و همراه همسرش یک موسسه همگام با مسائل حوزه&zwnj;ی کودک و نوجوان تأسیس کرد که هدف اصلی آن، مطالعه مسائل مربوط به کودکان و پژوهش درباره رفتار و خلق&zwnj;وخوی آن&zwnj;ها بود.</span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\">نادر ابراهيمي نویسنده&zwnj;ای شاخص و برجسته&zwnj; است که در طی سال&zwnj;ها فعالیتش داستان&zwnj;های ماندگار و زیبایی به یادگار گذاشته است. &laquo;با سرودخوان جنگ در خطه نام و ننگ&raquo; یکی از آثار اوست که سال 1366 منتشر شد و روایت سفر به جبهه جنگ ایران و عراق این نویسنده است. او در این اثر با قلمی توانا فضای جنگ را ترسیم کرده است و یک داستان خواندنی به&zwnj;جا گذاشته است. &laquo;آتش بدون دود&raquo; یکی دیگر از آثار معروف &laquo;نادر ابراهیمی&raquo; است که در هفت جلد منتشر شد. این <strong>رمان </strong>بلند روایت جریان&zwnj;های انقلابی معاصر است که براساس آن در دهه&zwnj;ی پنجاه مجموعه تلویزیونی ساخته شد. &laquo;سه دیدار با مردی که از فراسوی باور ما می&zwnj;آمد&raquo; یکی دیگر از آثار این نویسنده است که دیدار این نویسنده با &laquo;امام خمینی&raquo; را شرح و گزارش می&zwnj;دهد. نسخه&zwnj;ی الکترونیک این آثار به همراه سایر آثار &laquo;نادر ابراهیمی&raquo; در سایت و اپلیکیشن فیدیبو برای خرید و دانلود موجود است. </span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\"><img alt=\"جلد کتاب صوتی یک عاشقانه آرام با صدای پیام دهکردی\" src=\"https://cdn.fidibo.com/images/content/images/yek_asheghane_arambooks.jpg.jpg\" /></span></p>\r\n', '38000', 'نوین کتاب', '1612364754_1b8a2a49801404d6e675.jpg', '1612364754_cb9cde8082f1d85b2fa1.mp3', 3, 18),
(9, 23, 'مردی به نام اوه', '<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\">هفته&zwnj;نامه معتبر اشپیگل در معرفی کتاب &laquo;مردی به نام اوه&raquo; نوشته است: &laquo;کسی که از این رمان خوشش نیاید، بهتر است اصلاً هیچ کتابی نخواند.&raquo;</span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\"><img alt=\"\" src=\"https://cdn.fidibo.com/images/content/images/A_Man_Called_Ovebook.jpg.jpg\" /></span></p>\r\n\r\n<h2 dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\"><strong>درباره کتاب مردی به نام اوه</strong></span></h2>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\">کتاب صوتی &laquo;مردی به نام اوه&raquo; &nbsp;<span dir=\"LTR\">A Man Called Ove</span>اثر &laquo;فردریک بکمن&raquo; سال 2012 منتشر شده است. این کتاب روایت زندگی پیرمردی عبوس و کم&zwnj;حرف است که بعد از مرگ همسرش تصمیم به خودکشی می&zwnj;گیرد. او یک روز صبح در میان این یکنواختی جریان زندگی&zwnj;اش با اتفاقی چالش&zwnj;برانگیز که مسیر داستان را تغییر می&zwnj;دهد روبه&zwnj;رو می&zwnj;شود. زنی ایرانی به نام پروانه که باردار است با همسرش به صندوق پستی خانه&zwnj;ی این پیرمرد کوبیده می&zwnj;شوند و خواننده را وارد فرازوفرود&zwnj;های داستانی طنزآلود می&zwnj;&lrm;&zwnj;کنند. </span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\">کتاب صوتی &nbsp;&laquo;مردی به نام اووه&raquo; یکی از پرفروش&zwnj;ترین رمان&zwnj;های جهان در سال&zwnj;های اخیر است که به بیش از سی زبان ترجمه شده است. این اثر اولین رمان &laquo;فردریک بکمن&raquo; است که از موفقیت چشمگیری برخوردار شد. براساس آن در سال 2015 &laquo;هانس هولم&raquo; فیلم&zwnj;نامه&zwnj;نویس اهل سوئد فیلم سینمایی موفقی ساخت که نامزد شش جایزه در پنجاه و یکمین جوایز گلدبگ <span dir=\"LTR\">Guldbagge Awards</span> شد. این فیلم یکی از پنج فیلم نامزد جایزه اسکار سال 2016 برای بهترین فیلم غیر انگلیسی&zwnj;زبآن&zwnj;هم شد. &laquo;فردريك بكمن&raquo; داستان &laquo;مردی به نام اوه&raquo; را به زبان طنز و ساده نوشته و شخصیت&zwnj;هایی معمولی که از دل جامعه بیرون آمده&zwnj;اند را به تصویر کشیده است. او مسئله اجتماعی و ناراحت&zwnj;کننده&zwnj;ی خودکشی را درون&zwnj;مایه&zwnj;ی داستانش قرار داده و آن را به زیبایی و با جزییات تمام ترسیم کرده است. </span></p>\r\n\r\n<h2 dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\"><strong>درباره فردریک بکمن</strong></span></h2>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\">&laquo;کارل فردریک بکمن&raquo; <span dir=\"LTR\">Fredrik Backman</span> نویسنده و وبلاگ&zwnj;نویس سوئدی در تاریخ 2 ژانویه سال 1981 در استکهلم به دنیا آمد. او از کودکی به خواندن و نوشتن علاقه داشت و کتاب&zwnj;های متعددی مطالعه می&zwnj;کرد. او از همان دوران نوشتن را آغاز و وبلاگ&zwnj; نویسی را دنبال کرد. او مدتی هم در برخی از روزنامه&zwnj;ها و نشریات سوئد ازجمله &laquo;مترو&raquo; می&zwnj;نوشت و به&zwnj;عنوان یک وبلاگ نویس پرطرفدار شناخته شده بود. او در جوانی شغل&zwnj;های گوناگونی ازجمله رانندگی لیفتراک و کامیون، کار در بازار میوه را امتحان کرد ولی هیچ&zwnj;گاه نوشتن را متوقف نکرد. او سال 2012 با انتشار کتاب محبوب و پرفروش &laquo;مردی به نام اوه&raquo; به شهرت جهانی رسید و به&zwnj;عنوان نویسنده&zwnj;ای زبردست شناخته شد. او سال 2013 موفق&zwnj;ترین نویسنده&zwnj;ی سوئد معرفی شد و نویسندگی را به&zwnj;عنوان حرفه&zwnj;اش برگزید. </span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\">&laquo;فردریک بکمن&raquo; سال 2015 دومین کتابش با عنوان &laquo;مادربزرگ سلام رساند و گفت متأسف است&raquo; را منتشر کرد که آن&zwnj;هم به فارسی ترجمه شده است. او داستان&zwnj;نویسی را طی این سال&zwnj;ها ادامه داد و کتاب &laquo;بریت&zwnj;ماری اینجا بود&raquo; را هم منتشر کرد که شباهت&zwnj;هایی با داستان &laquo;مردی به نام اوه&raquo; دارد. &laquo;و هر روز صبح راه خانه دور و دورتر می&zwnj;شود&raquo;، &laquo;معامله زندگی با زنی خاکستری پوش&raquo;، &laquo;شهر خرس&raquo;، &laquo;ما در برابر شما&raquo;، &laquo;و من دوستت دارم&raquo; و &laquo;معامله زندگی&raquo; ازجمله آثار دیگر این نویسنده هستند که به فارسی ترجمه&zwnj; شده&zwnj;اند و نسخه&zwnj;ی الکترونیک همه&zwnj;ی آن&zwnj;ها در سایت و اپلیکیشن فیدیبو برای خرید و دانلود موجود است. </span></p>\r\n\r\n<h2 dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\"><strong>در بخشی از کتاب مردی به نام اوه می&zwnj;شنویم</strong></span></h2>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\">در فاصله&zwnj;ای که قهوه&zwnj;اش عمل می&zwnj;آمد، کت&zwnj;وشلوار آبی نفتی&zwnj;اش را پوشید، دمپایی&zwnj;های چوبی&zwnj;اش را پا کرد و، مثل همه&zwnj;ی مردهای میان&zwnj;سالی که می&zwnj;دانند دنیا پشیزی نمی&zwnj;ارزد دست&zwnj;هایش را توی جیب فروکرد. بعد بازرسی صبحگاهی&zwnj;اش را در محله آغاز کرد. درست مثل هر روز صبح. وقتی اوه از در خانه&zwnj;اش پا بیرون گذاشت، ردیف خانه&zwnj;های اطراف در سکوت و تاریکی به خواب&zwnj;رفته بود و هیچ جنبنده&zwnj;ای آن حوالی به چشم نمی&zwnj;خورد. اوه با خودش فکر کرد، می&zwnj;دانستم. در این خیابان هیچ&zwnj;کس به خودش زحمت نمی&zwnj;دهد زودتر از معمول از خواب بیدار شود. این روزها، فقط کسانی در این محله زندگی می&zwnj;کردند که استخدام جایی نبودند و یا اصولاً آدم&zwnj;های درست&zwnj;وحسابی&zwnj;ای نبودند.</span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\">گربه باحالتی بی&zwnj;تفاوت وسط پیاده&zwnj;روی بین خانه&zwnj;ها نشسته بود. البته دم نصفه&zwnj;ای داشت و یکی از گوش&zwnj;هایش کنده شده بود. موهای تنش گله &zwnj;به گله ريخته بود. انگار کسی مشت مشت موهایش را کنده باشد. در مجموع، حیوان خوش&zwnj;برورویی نبود.</span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\">اوه قدمی به جلو برداشت. گربه از جا بلند شد. اوه توقف کرد. هر دو جند ثانیه&zwnj;ای ایستادند و همدیگر را برانداز کردند، مثل دو آشوبگر بالقوه در میخانه&zwnj;ای در یک شهر کوچک. اوه با خودش فکر کرد یکی از دمپایی&zwnj;هایش را به&zwnj;سوی گربه پرتاب کند. گربه انگار داشت افسوس می&zwnj;خورد که چرا دمپایی&zwnj;اش را نیاورده تا پرتابش کند سمت اوه.</span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\">اوه نعره زد: &laquo;گم شو!&raquo; فریادش جنان ناگهانی بود که گربه جست زد عقب. نگاهی به مرد پنجاه&zwnj;ونه&zwnj;ساله و دمپایی&zwnj;هایش انداخت، بعد برگشت و سلانه&zwnj;سلانه راهش را کشید و رفت. اوه می&zwnj;توانست قسم بخورد که گربه پیش از رفتن برای او پشت چشم نازک کرده.</span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\">با خودش و &laquo;نکبت.&raquo; و نگاهی به ساعت مچی&zwnj;اش انداخت. دو دقیقه مانده به شش. زمان داشت می&zwnj;گذشت و آن گربه&zwnj;ی لعنتی در کار بازرسی&zwnj;اش وقفه ایجاد کرده بود. از این بهتر نمی&zwnj;شد.</span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\">شروع کرد به راه رفتن در مسیر میان خانه&zwnj;ها و به سمت محوطه&zwnj;ی پارکینگ رفت، مثل هر روز صبح. کنار تابلوی راهنمایی که خطاب به راننده&zwnj;ها می&zwnj;گفت اجازه ندارند وارد محوطه&zwnj;ی مسکونی شوند ایستاد. به پايه&zwnj;ی فلزی تابلو لگدی زد. پایه کج نبود، اما ضرر ندارد آدم همه&zwnj;چیز را کنترل کند.</span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\">اوه از آن مردها است که همه&zwnj;چیز را با لگد کنترل می&zwnj;کند.</span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\">قدم&zwnj;زنان تا محوطه&zwnj;ی پارکینگ رفت و سر تا ته تمام گاراژها را دید زد تا خیالش راحت شود سرقتی چیزی رخ نداده یا دارو دسته&zwnj;ی خرابکارها آتشی به&zwnj;پا نکرده باشند. تابه&zwnj;حال، چنین اتفاق&zwnj;هایی در این محله سابقه نداشت، اما این باعث نمی&zwnj;شد اوه دست از بازرسی&zwnj;هایش بکشد. دستگيره در گاراژ خودش را که سابش آنجا پارک شده بود سه مرتبه با فشار کشید. درست مثل همه&zwnj;ی صبح&zwnj;های دیگر.</span></p>\r\n\r\n<p dir=\"RTL\" style=\"text-align:justify\"><span style=\"color:black\"><img alt=\"\" src=\"https://cdn.fidibo.com/images/content/images/A_Man_Called_Ovebooks.jpg.jpg\" /></span></p>\r\n', '15000', 'نوین کتاب', '1612364802_54fea1465f26d23e4131.jpg', '1612364802_bd0d4634fb03d0e9d7f7.mp3', 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_books` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `description` text NOT NULL,
  `stars` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `id_books`, `id_users`, `description`, `stars`) VALUES
(1, 7, 24, 'خلاصه خوبی داشت . تشکر', 2),
(2, 7, 25, 'بسیار عالی بود ممنونم', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_books` int(11) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `id_users`, `id_books`, `price`) VALUES
(3, 24, 7, 28000),
(4, 24, 8, 38000),
(5, 25, 7, 28000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`) VALUES
(23, 'admin', 'admin', '$2y$10$J79yvSD0ubuQaOyMxlUiKerE1B8d2ECVdKLTEXJu3SS35WnFDZ6YW'),
(25, 'کاربر تست 2', 'test2', '$2y$10$wDpGXG3ItsT5au0yq8WwY.0I7krL7OgI.wFe1.kJBpGGJLrV2ZU3a'),
(24, 'کاربر تست', 'test', '$2y$10$ILhSld8zBfTl/U.y9wf7r.Zlo2ht.5w4Sf141G4/Lss38ZsUZzmy.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
