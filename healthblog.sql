-- MySQL dump 10.14  Distrib 5.5.68-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: fitfoodjourne
-- ------------------------------------------------------
-- Server version	5.5.68-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
-- MySQL dump 10.14  Distrib 5.5.68-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: fitfoodjourney
-- ------------------------------------------------------
-- Server version	5.5.68-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `likes` int(11) DEFAULT '0',
  `is_best` tinyint(1) DEFAULT '0',
  `is_expert` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `answers`
--
-- WHERE:  1 LIMIT 10

LOCK TABLES `answers` WRITE;
/*!40000 ALTER TABLE `answers` DISABLE KEYS */;
INSERT INTO `answers` VALUES (1,1,1,'you can take protine reach items like milk, banana, egg ',3,1,0,'2025-09-04 13:07:22');
/*!40000 ALTER TABLE `answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `subject` varchar(150) DEFAULT NULL,
  `message` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--
-- WHERE:  1 LIMIT 10

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
INSERT INTO `contact_messages` VALUES (1,'Dr. John','mohdadil67719@gmail.com',NULL,'vgff','2025-07-23 13:33:26'),(2,'mohd','adil@dev.deepijatel.com',NULL,'asdsd','2025-09-04 13:16:50');
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meal_plans`
--

DROP TABLE IF EXISTS `meal_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meal_plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `details` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meal_plans`
--
-- WHERE:  1 LIMIT 10

LOCK TABLES `meal_plans` WRITE;
/*!40000 ALTER TABLE `meal_plans` DISABLE KEYS */;
INSERT INTO `meal_plans` VALUES (1,'healthy breakfast','2025-09-09 15:01:00','[{\"food\":\"Milk (cow, 3.25%)\",\"grams\":\"100\",\"cal\":\"61\",\"protein\":\"3.2\",\"carbs\":\"4.8\",\"fat\":\"3.3\"},{\"food\":\"Banana (raw)\",\"grams\":\"100\",\"cal\":\"89\",\"protein\":\"1.1\",\"carbs\":\"23.0\",\"fat\":\"0.3\"},{\"food\":\"Oats (dry)\",\"grams\":\"100\",\"cal\":\"389\",\"protein\":\"16.9\",\"carbs\":\"66.0\",\"fat\":\"6.9\"},{\"food\":\"Almonds (raw)\",\"grams\":\"100\",\"cal\":\"579\",\"protein\":\"21.0\",\"carbs\":\"22.0\",\"fat\":\"50.0\"},{\"food\":\"Peanuts (roasted)\",\"grams\":\"100\",\"cal\":\"585\",\"protein\":\"24.0\",\"carbs\":\"21.0\",\"fat\":\"49.0\"}]','2025-09-08 09:30:10'),(2,'Healthy lunch plan ','2025-09-10 11:46:00','[{\"food\":\"Milk (cow, 3.25%)\",\"grams\":\"100\",\"cal\":\"61\",\"protein\":\"3.2\",\"carbs\":\"4.8\",\"fat\":\"3.3\"}]','2025-09-09 06:16:10'),(3,'Lunch plan ','2025-09-11 15:58:00','[{\"food\":\"Yogurt (plain)\",\"grams\":\"100\",\"cal\":\"59\",\"protein\":\"10.0\",\"carbs\":\"3.6\",\"fat\":\"0.4\"},{\"food\":\"Oats (dry)\",\"grams\":\"100\",\"cal\":\"389\",\"protein\":\"16.9\",\"carbs\":\"66.0\",\"fat\":\"6.9\"},{\"food\":\"Dosa (plain)\",\"grams\":\"100\",\"cal\":\"168\",\"protein\":\"4.0\",\"carbs\":\"30.0\",\"fat\":\"3.7\"}]','2025-09-10 10:27:34');
/*!40000 ALTER TABLE `meal_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `motivational_quotes`
--

DROP TABLE IF EXISTS `motivational_quotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `motivational_quotes` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `quote` varchar(255) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `motivational_quotes`
--
-- WHERE:  1 LIMIT 10

LOCK TABLES `motivational_quotes` WRITE;
/*!40000 ALTER TABLE `motivational_quotes` DISABLE KEYS */;
INSERT INTO `motivational_quotes` VALUES (69,'Your only limit is you. Push harder today. ðŸ’ª','2025-09-02 11:44:06'),(70,'The pain you feel today will be the strength you feel tomorrow. ðŸ”¥','2025-09-02 11:44:19'),(71,'Fitness is not about being better than someone else. Itâ€™s about being better than you used to be. ðŸƒ','2025-09-02 11:44:32'),(72,'Train insane or remain the same. ðŸ‹ï¸','2025-09-02 11:44:44'),(73,'Donâ€™t stop until youâ€™re proud. ðŸŒŸ','2025-09-02 11:45:02'),(74,'The body achieves what the mind believes. ðŸ§ ','2025-09-02 11:46:00'),(75,'Sweat now, shine later. ðŸ’¦','2025-09-02 11:46:08'),(76,'Every workout is progress. ðŸ”‘','2025-09-02 11:46:15'),(77,'Stronger every day, one step at a time. ðŸš¶','2025-09-02 11:46:23'),(78,'Your health is your wealth. ðŸ’°','2025-09-02 11:46:38');
/*!40000 ALTER TABLE `motivational_quotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_comments`
--

DROP TABLE IF EXISTS `post_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `comment` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parent_id` int(11) DEFAULT NULL,
  `upvotes` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_comments`
--
-- WHERE:  1 LIMIT 10

LOCK TABLES `post_comments` WRITE;
/*!40000 ALTER TABLE `post_comments` DISABLE KEYS */;
INSERT INTO `post_comments` VALUES (2,4,'adil','awsome i very help full','2025-08-01 06:36:21',NULL,2),(3,11,'adil','this is very delicious ','2025-08-01 07:21:45',NULL,0),(7,5,'Dr. Priya Sharma','hihih','2025-08-01 11:43:49',NULL,0),(8,11,'john','yes abosulitly','2025-08-12 07:36:01',3,4),(10,15,'harish','very helpfull','2025-08-12 10:57:49',NULL,1),(11,15,'mohd','yes true','2025-08-12 10:59:45',10,1);
/*!40000 ALTER TABLE `post_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_likes`
--

DROP TABLE IF EXISTS `post_likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_ip` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_likes`
--
-- WHERE:  1 LIMIT 10

LOCK TABLES `post_likes` WRITE;
/*!40000 ALTER TABLE `post_likes` DISABLE KEYS */;
INSERT INTO `post_likes` VALUES (1,15,'172.17.19.160','2025-08-01 06:42:54'),(2,7,'172.17.19.160','2025-08-01 06:43:54'),(6,11,'172.17.19.160','2025-08-01 10:55:10'),(8,4,'172.17.19.158','2025-08-01 11:23:31'),(9,5,'172.17.19.160','2025-08-01 11:43:35'),(10,11,'172.17.18.195','2025-08-07 10:21:29'),(11,11,'172.17.18.196','2025-08-07 10:49:26'),(12,6,'172.17.18.195','2025-08-07 12:56:23'),(14,19,'10.0.6.11','2025-08-12 10:45:44'),(15,22,'172.17.18.151','2025-09-02 11:56:15');
/*!40000 ALTER TABLE `post_likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `location` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `tags` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `scheduled_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--
-- WHERE:  1 LIMIT 10

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Morning Healthy Tips','Common and beneficial morning drink options\r\nWarm Lemon Water: This simple drink hydrates your body, stimulates digestion, and provides a boost of vitamin C. Squeeze half a lemon into warm water and consider adding a teaspoon of honey for added benefits.\r\nGreen Tea: Packed with antioxidants called catechins, green tea can help boost metabolism and may assist with fat burning. It also offers a gentle energy boost from caffeine without the jitters associated with coffee.\r\nCoconut Water: This natural and hydrating drink is rich in electrolytes like potassium, sodium, and magnesium. It helps rehydrate the body, especially after a workout, and can balance electrolytes.\r\nSmoothies: Blended drinks made with fruits, vegetables, and other ingredients can provide a nutrient-packed and customizable morning option. Consider combinations like spinach, banana, and almond milk for energy and nutrients.\r\nHerbal Teas: Options like peppermint, chamomile, or ginger tea offer calming or invigorating benefits. Peppermint aids digestion, chamomile promotes relaxation, and ginger boosts immunity and helps reduce nausea.\r\nApple Cider Vinegar (ACV) Drink: Mix 1-2 tablespoons of ACV with water, and optionally add honey or cinnamon for flavor. ACV is believed to support digestion and detoxification.\r\nChia Seed Water: Soaking chia seeds in water creates a gel-like drink rich in omega-3 fatty acids, fiber, and protein. This can help keep you feeling full and hydrated. \r\nAyurvedic perspective\r\nAyurveda suggests starting the day with warm water or herbal drinks to awaken the digestive fire and eliminate toxins. Some Ayurvedic morning drink recommendations include: \r\nWarm Water with Lemon and Honey: Stimulates digestion, balances Kapha dosha, and detoxifies the body.\r\nGinger Tea: Improves digestion, reduces bloating, and helps with Vata and Kapha imbalances.\r\nAmla (Indian Gooseberry) Juice: Rich in vitamin C and antioxidants, supports digestive health, immunity, and balances doshas.\r\nAjwain (Carom Seeds) Water: Reduces gas, bloating, and indigestion. \r\nChoosing the best option\r\nThe best morning health drink for you will depend on your individual preferences, dietary needs, and desired benefits. It\'s recommended to consult with a healthcare professional or registered dietitian to determine the most suitable option for your specific health goals and any existing conditions. Remember, a healthy lifestyle that includes a balanced diet and regular exercise is crucial for overall health and well-being.','https://maps.app.goo.gl/qe4Y7KdbKBfSgkLK8','Health','9553-01-lemon_water-1296x728-body-image-01.webp,13-Healthy-Drinks-Your-Kids-Should-Be-Drinking.jpg,istockphoto-592365236-612x612.jpg,healthy drink.webp',NULL,'2025-07-23 13:29:27',NULL),(3,'Healthy Skin Care Tips','Here are some key tips:\r\nCleanse your skin: Wash your face gently morning and night, and after sweating, to remove dirt, oil, and makeup. Use a mild cleanser and lukewarm water.\r\nMoisturize: Apply moisturizer daily, especially after cleansing, to keep your skin hydrated and smooth. If you have dry skin, consider using a moisturizer with SPF for added sun protection.\r\nProtect yourself from the sun: Limit sun exposure, especially between 10 am and 4 pm when UV rays are strongest. Use a broad-spectrum sunscreen with an SPF of at least 30, and wear protective clothing like hats and long sleeves.\r\nStay hydrated: Drink plenty of water throughout the day to keep your skin hydrated from the inside out.\r\nEat a healthy diet: Include lots of fruits, vegetables, whole grains, and lean proteins in your diet.\r\nGet enough sleep: Aim for 7-9 hours of sleep per night to allow your skin to regenerate and repair itself.\r\nManage stress: Stress can exacerbate skin problems, so find healthy ways to cope with stress, such as exercise, meditation, or spending time with loved ones.\r\nDon\'t smoke: Smoking can prematurely age your skin and increase the risk of wrinkles and skin cancer. \r\nAdditional tips\r\nConsider exfoliation: Gently exfoliate once or twice a week to remove dead skin cells and reveal smoother, brighter skin.\r\nUse targeted treatments: If you have specific concerns like acne or hyperpigmentation, consult with a dermatologist or aesthetician for personalized advice and product recommendations, such as vitamin C serums or retinoids.\r\nBe gentle with your skin: Avoid harsh scrubbing, and pat your skin dry with a towel instead of rubbing.\r\nClean your pillowcases and makeup brushes regularly: This helps prevent bacteria build-up that can contribute to breakouts.\r\nDouble cleanse at night: This helps remove debris, makeup, and oil from the day, ensuring a deeper clean. \r\nRemember, consistency is key when it comes to skincare. By incorporating these tips into your daily routine, you can promote healthy, glowing skin. ',NULL,'Health','5-Natural-Beauty-tips-for-daily-body-skin-care.jpg.webp',NULL,'2025-07-24 06:14:03',NULL),(4,'Hair care ','1. Understand your hair type\r\nDifferent hair types (straight, wavy, curly, coily, fine, thick, dry, oily) have unique needs.\r\nChoose products and adjust your routine based on your specific hair type, advises the American Academy of Dermatology. \r\n2. Washing and conditioning\r\nFrequency: Wash your hair as often as it gets dirty or oily, typically 2-3 times per week for most hair types. Fine, straight hair may need more frequent washing, while curly or dry hair may benefit from less frequent washing. Over-washing can strip away natural oils and lead to dryness and damage.\r\nShampoo: Choose a shampoo that matches your hair type. For oily hair, opt for clarifying shampoos. For dry hair, choose hydrating shampoos. Gently massage shampoo into your scalp, letting it rinse through the lengths of your hair.\r\nConditioner: Always use a conditioner after shampooing to moisturize and detangle. Apply conditioner to the ends and mid-lengths of your hair, avoiding the scalp to prevent greasy roots, according to Evalectric.\r\nWater Temperature: Use lukewarm water for washing your hair, as hot water can strip away natural oils. \r\n3. Gentle handling\r\nWet Hair: Wet hair is fragile. Avoid rubbing your hair vigorously with a towel; instead, gently squeeze out excess water with a soft towel or t-shirt.\r\nDetangling: Use a wide-tooth comb or your fingers to detangle wet hair, starting from the ends and working your way up. If you have thick, curly hair, detangle it in the shower before rinsing out your conditioner. \r\n4. Minimize heat styling and chemical treatments\r\nHeat Styling Tools: Limit your use of blow dryers, curling irons, and straighteners.\r\nHeat Protectant: If you must use heat tools, always apply a heat protectant spray or serum to shield your hair from damage. Use the lowest effective heat setting.\r\nChemical Treatments: Reduce the frequency of chemical treatments like coloring, perms, or relaxers to minimize damage. If you color your hair, choose color-safe and sulfate-free products, advises Blonde Faith Salon. \r\n5. Regular maintenance\r\nTrimming: Get regular trims every 6-8 weeks (or more frequently if prone to split ends) to remove split ends and maintain healthy hair length.\r\nDeep Conditioning: Use a deep conditioner or hair mask once a week for added moisture and to repair damage, suggests L Salon and Color Group. \r\n6. Lifestyle factors\r\nHealthy Diet: A balanced diet rich in vitamins, minerals, proteins, and omega-3 fatty acids supports healthy hair growth and strength. Include foods like lean meats, fish, eggs, nuts, seeds, fruits, and vegetables in your diet.\r\nHydration: Drink plenty of water to keep your hair and scalp hydrated from within.\r\nScalp Health: A healthy scalp is crucial for healthy hair growth. Massage your scalp regularly to stimulate blood circulation and promote nutrient delivery to hair follicles. \r\n7. Natural remedies\r\nOils: Natural oils like coconut oil, almond oil, and argan oil can nourish and strengthen your hair. Massage warm oil into your scalp and hair once or twice a week.\r\nAloe Vera: Apply fresh aloe vera gel to the scalp and hair for its soothing and hydrating properties.\r\nOnion Juice: Onion juice is a known remedy for hair growth, thanks to its sulfur content. Apply it to your scalp and rinse after 15-30 minutes.\r\nGreen Tea: Use cooled green tea as a final rinse after shampooing for its antioxidant benefits. \r\nBy understanding your hair type and incorporating these tips into your routine, you can help keep your hair strong, healthy, and vibrant. Remember that consistency is key for achieving the best results. ',NULL,'Health','Hair-Rebonding_2c843ccc-6854-4ea9-9afa-00f1af8e339f_1024x400.webp',NULL,'2025-07-24 06:17:10',NULL),(5,'Healthy Heart tips','Eat a healthy, balanced diet\r\nA low-fat, high-fibre diet is recommended, which should include plenty of fresh fruit and vegetables (5 portions a day) and whole grains.\r\n\r\nYou should limit the amount of salt you eat to no more than 6g (0.2oz) a day as too much salt will increase your blood pressure. 6g of salt is about 1 teaspoonful.\r\n\r\nThere are 2 types of fat: saturated and unsaturated. You should avoid food containing saturated fats, because these will increase the levels of bad cholesterol in your blood.\r\n\r\nFoods high in saturated fat include:\r\n\r\nmeat pies\r\nsausages and fatty cuts of meat\r\nbutter\r\nghee â€“ a type of butter often used in Indian cooking\r\nlard\r\ncream\r\nhard cheese\r\ncakes and biscuits\r\nfoods that contain coconut or palm oil\r\nHowever, a balanced diet should still include unsaturated fats, which have been shown to increase levels of good cholesterol and help reduce any blockage in your arteries.\r\n\r\nFoods high in unsaturated fat include:\r\n\r\noily fish\r\navocados\r\nnuts and seeds\r\nsunflower, rapeseed, olive and vegetable oils\r\nYou should also try to avoid too much sugar in your diet, as this can increase your chances of developing diabetes, which is proven to significantly increase your chances of developing CHD.',NULL,'Health','heart.jpg',NULL,'2025-07-24 06:24:44',NULL),(6,'Hyderabadi Chicken Biryani','Marinade:\r\n\r\n10 black peppercorns\r\n\r\n6 whole cloves\r\n\r\n5 cardamom pods\r\n\r\n2 cinnamon sticks\r\n\r\n2 whole star anise pods\r\n\r\nÂ½ teaspoon kala jeera (black cumin seeds)\r\n\r\n1 bunch fresh cilantro leaves\r\n\r\n1 bunch fresh mint leaves\r\n\r\n1 cup plain yogurt\r\n\r\n2 teaspoons lemon juice\r\n\r\n2 teaspoons ginger-garlic paste\r\n\r\n2 teaspoons chili powder\r\n\r\n1 teaspoon biryani masala powder (such as Dunya)\r\n\r\nÂ¼ teaspoon ground turmeric\r\n\r\n1 pound chicken thighs\r\n\r\nBiryani:\r\n\r\n3 Â½ cups water\r\n\r\n2 â…“ cups basmati rice\r\n\r\n4 bay leaves, divided\r\n\r\nÂ½ cup warm milk\r\n\r\n1 pinch saffron threads\r\n\r\nÂ¼ cup ghee (clarified butter), divided\r\n\r\n2 onions, thinly sliced\r\n\r\n2 green chile peppers, chopped\r\n\r\nLocal Offers\r\nOops! We cannot find any ingredients on sale near you. Do we have the correct zip code?\r\nDirections\r\nPlace black peppercorns, cloves, cardamom, cinnamon sticks, star anise, and kala jeera into a spice grinder; grind to a fine powder.\r\n\r\nPlace cilantro and mint leaves in the bowl of a food processor; pulse until coarsely chopped.\r\n\r\nCombine spice powder, cilantro-mint mixture, yogurt, lemon juice, ginger-garlic paste, chili powder, biryani masala powder, and turmeric in a large glass or ceramic bowl. Add chicken; toss to evenly coat. Cover bowl with plastic wrap and marinate in the refrigerator, about 2 hours.\r\n\r\nBring water and rice to a boil in a saucepan; add 2 bay leaves. Reduce heat to medium-low, cover, and simmer until rice is partially cooked through and still firm, about 5 minutes. Drain; set aside.\r\n\r\nCombine milk and saffron in a small bowl; stir and set aside.\r\n\r\nHeat ghee in a large pot with a tight-fitting lid over medium-high heat. Add onions; cook and stir until golden brown, about 15 minutes. Drain on paper towels; set aside.\r\n\r\nReduce heat to low. Add remaining 2 bay leaves and chile peppers; cook and stir until fragrant, 1 to 2 minutes. Carefully transfer 1 tablespoon ghee from the pot to a small bowl; set aside.\r\n\r\nRemove chicken from marinade, wiping excess marinade off; add chicken to the pot. Discard remaining marinade. Cook over medium heat until no longer pink, about 2 minutes per side; spread rice on top, then sprinkle on onions. Drizzle reserved ghee and saffron milk over rice and onions.\r\n\r\nCover the pot; cook over high heat, about 8 minutes. Reduce heat to low; continue cooking, about 5 minutes. Remove from heat; let stand, covered, until rice is tender and an instant-read thermometer inserted into the thickest part of chicken reads 165 degrees F (74 degrees C), about 15 minutes more.\r\n\r\nCook\'s Notes:\r\nSubstitute lamb for chicken if preferred.\r\n\r\nSubstitute oil for ghee if desired.\r\n\r\nIf you want biryani to look dry, sprinkle oil on rice after you drain it and before you add it to the chicken.','','Recipes','biryani in hyderabad.webp','hyderabadi,chicken','2025-07-24 06:27:29','1970-01-01 05:30:00'),(7,'Taj Falaknuma Palace - Hyderabad','Falaknuma Palace, located in Hyderabad, Telangana, India, is a former palace now operating as a luxury heritage hotel managed by Taj Hotels. \r\nAll You Need To Know About Falaknuma Palace\r\nA leisurely walk through the Falaknuma Palace! - Star of Mysore\r\nInteresting Facts about Falaknuma Palace, a Heirloom of ...\r\nHotel Review: Taj Falaknuma Palace, Hyderabad, India - Brad ...\r\nTAJ FALAKNUMA PALACE (2025) All You Need to Know BEFORE You ...\r\nHere\'s a look at its history:\r\nConstruction: The palace was built by Nawab Sir Viqar-ul-Umra, the Prime Minister of Hyderabad and the sixth Nizam\'s uncle and brother-in-law. Construction started on March 3, 1884, and took nine years to complete, finishing in 1893. The estimated cost of construction was â‚¹4 million, equivalent to â‚¹1.8 billion or US$22 million in 2023.\r\nDesign: Designed by English architect William Ward Marrett, Falaknuma Palace showcases a blend of Italian and Tudor architecture, built entirely from Italian marble. The name \"Falaknuma\" means \"Like the Sky\" or \"Mirror of Sky\" in Urdu, a reflection of its hilltop location 2,000 feet above the city. The palace\'s layout is unique, resembling a scorpion with two wings extending northward.\r\nNizam\'s Ownership: In 1897, the sixth Nizam of Hyderabad, Mir Mahbub Ali Khan, was invited to stay at the palace and was so impressed that he acquired it from Sir Viqar-ul-Umra. The Nizam used it as a royal guest house, hosting dignitaries like King George V, Queen Mary, Edward VIII, and Tsar Nicholas II.\r\nNeglect and Restoration: After the 1950s, the palace fell into disuse. In 2000, Prince Mukarram Jah, the eighth Nizam of Hyderabad, leased the palace to the Taj Group of Hotels for restoration and renovation. The restoration project, meticulously supervised by Princess Esra Jah (the Nizam\'s first wife), took a decade to complete. The renovated Taj Falaknuma Palace opened in November 2010.\r\nCurrent Status: Today, the Taj Falaknuma Palace is a luxurious heritage hotel that allows guests to experience the grandeur of the Nizam\'s era. It features 60 lavishly decorated rooms, 22 spacious halls, a renowned collection of the Nizam\'s artefacts, including a unique jade collection, and a magnificent library. It\'s a popular venue for events and provides a glimpse into Hyderabad\'s rich regal heritage.','https://maps.app.goo.gl/UTjF3D148EiRW4YK6','Travel','Falaknuma-Palace-Taj.jpg','Hyderabad','2025-07-24 06:32:48','1970-01-01 05:30:00'),(8,'Golconda Fort -Hyderabad','Golconda is a fortified citadel and ruined city located on the western outskirts of Hyderabad, Telangana, India.[1][2] The fort was originally built by Kakatiya ruler PratÄparudra in the 11th century out of mud walls.[3] It was ceded to the Bahmani Kings from Musunuri Nayakas during the reign of the Bahmani Sultan Mohammed Shah I, during the first Bahmani-Vijayanagar War. Following the death of Sultan Mahmood Shah, the Sultanate disintegrated and Sultan Quli, who had been appointed as the Governor of Hyderabad by the Bahmani Kings, fortified the city and made it the capital of the Golconda Sultanate. Because of the vicinity of diamond mines, especially Kollur Mine, Golconda flourished as a trade centre of large diamonds known as Golconda Diamonds. Golconda fort is currently abandoned and in ruins. The complex was put by UNESCO on its \"tentative list\" to become a World Heritage Site in 2014, with other forts in the region, under the name Monuments and Forts of the Deccan Sultanate (despite there being a number of different sultanates).[1]\r\n\r\nHistory\r\n\r\nRuins of the fort\r\n\r\nView of the Baradari at the Golconda Fort\r\nThe origins of the Golconda fort can be traced back to the 11th century. It was originally a small mud fort built by PratÄparudra of the Kakatiya Empire.[3] The name Golconda is thought to originate from the Telugu à°—à±Šà°²à±à°²à°•à±Šà°‚à°¡ Gollakoá¹‡á¸a for \"Shepherd\'s hill\".[4][5] It is also thought that Kakatiya ruler Ganapatideva 1199â€“1262 built a stone hilltop outpost â€” later known as Golconda fort â€” to defend their western region.[6] The fort was later developed into a fortified citadel in 1518 by Sultan Quli of the Qutb Shahi Empire and the city was declared the capital of the Golconda Sultanate\r\n\r\nThe Bahmani kings took possession of the fort after it was made over to them by means of a sanad by the Rajah of Warangal.[3] Under the Bahmani Sultanate, Golconda slowly rose to prominence. Sultan Quli Qutb-ul-Mulk (r. 1487â€“1543), sent by the Bahmanids as a governor at Golconda, established the city as the seat of his governance around 1501. Bahmani rule gradually weakened during this period, and Sultan Quli (Quli Qutub Shah period) formally became independent in 1518, establishing the Qutb Shahi dynasty based in Golconda.[7][8][9] Over a period of 62 years, the mud fort was expanded by the first three Qutb Shahi sultans into the present structure: a massive fortification of granite extending around 5 km (3.1 mi) in circumference. It remained the capital of the Qutb Shahi dynasty until 1590 when the capital was shifted to Hyderabad. The Qutb Shahis expanded the fort, whose 7 km (4.3 mi) outer wall enclosed the city.\r\n\r\nDuring the early seventeenth century a strong cotton-weaving industry existed in Golconda. Large quantities of cotton were produced for domestic and exports consumption. High quality plain or patterned cloth made of muslin and calico was produced. Plain cloth was available as white or brown colour, in bleached or dyed variety. Exports of this cloth was to Persia and European countries. Patterned cloth was made of prints which were made indigenously with indigo for blue, chay-root for red coloured prints and vegetable yellow. Patterned cloth exports were mainly to Java, Sumatra and other eastern countries.[10] The fort finally fell into ruin in 1687 after an eight-month-long siege led to its fall at the hands of the Mughal emperor Aurangzeb, who ended the Qutb Shahi reign and took the last Golconda king, Abul Hassan Tana Shah, captive.[11][5]\r\n\r\nDiamonds\r\nThe Golconda fort used to have a vault where the famous Koh-i-Noor and Hope diamonds were once stored along with other diamonds.[12]\r\n\r\nGolconda is renowned for the diamonds found on the south-east at Kollur Mine near Kollur, Guntur district, Paritala and Atkur in Krishna district and cut in the city during the Kakatiya reign. At that time, India had the only known diamond mines in the world. Golconda was the market city of the diamond trade, and gems sold there came from a number of mines. The fortress-city within the walls was famous for diamond trade.[citation needed]\r\n\r\nIts name has taken a generic meaning and has come to be associated with great wealth. Some gemologists use this classification to denote the extremely rare Type IIa diamond, a crystal that essentially lacks nitrogen impurities and is therefore colorless; Many Type IIa diamonds, as identified by the Gemological Institute of America (GIA), have come from the mines in and around the Golconda region\r\n\r\nArchitecture\r\n\r\nGolconda fort is listed as an archaeological treasure on the official \"List of Monuments\" prepared by the Archaeological Survey of India under The Ancient Monuments and Archaeological Sites and Remains Act.[14] Golconda consists of four distinct forts with a 10 km (6.2 mi) long outer wall with 87 semicircular bastions (some still mounted with cannons), eight gateways, and four drawbridges, with a number of royal apartments and halls, temples, mosques, magazines, stables, etc. inside. The lowest of these is the outermost enclosure entered by the \"Fateh Darwaza\" (Victory gate, so called after Aurangzebâ€™s triumphant army marched in through this gate) studded with giant iron spikes (to prevent elephants from battering them down) near the south-eastern corner. An acoustic effect can be experienced at Fateh Darwazaan, a hand clap at a certain point below the dome at the entrance reverberates and can be heard clearly at the \"Bala Hisar\" pavilion, the highest point almost a kilometer away. This worked as a warning in case of an attack.\r\n\r\nThe \"Bala Hisar\" gate is the main entrance to the fort located on the eastern side. It has a pointed arch bordered by rows of scroll work. The spandrels have yalis and decorated roundels. The area above the door has peacocks with ornate tails flanking an ornamental arched niche. The granite block lintel below has sculpted yalis flanking a disc. The design of peacocks and lions is typical of Hindu architecture and underlies this fort\'s Hindu origins.\r\n\r\nThe Jagadamba temple, located next to the mosque of Ibrahim and the king\'s palace, is visited by hundreds of thousands of Hindu devotees during Bonalu festival every year.[15][16] Jagadamba temple is about 900 to 1,000 years old, dating back to early Kakatiya period.[17] A Mahankali temple is located in the vicinity, within Golconda fort.[18]\r\n\r\nThe fort also contains the tombs of the Qutub Shahi kings. These tombs display features of Indo-Islamic architecture and are located about 1 km (0.62 mi) north of the outer wall of Golconda. They are encircled by gardens and numerous carved stones.\r\n\r\nThe two individual pavilions on the outer side of Golconda are built on a point which is quite rocky. The \"Kala Mandir\" is also located in the fort. It can be seen from the king\'s durbar (king\'s court) which was on top of the Golconda fort.\r\n\r\nThe other buildings found inside the fort are: Habshi Kamans (Abyssian arches), Ashlah Khana, Taramati mosque, Ramadas Bandikhana, Camel stable, private chambers (kilwat), Mortuary bath, Nagina bagh, Ramasasa\'s kotha, Durbar hall, Ambar khana etc.','','Travel','golconda_fort.webp','hyderabad','2025-07-24 06:50:49','1970-01-01 05:30:00'),(9,'Chowmahalla Palace-Hyderabad','Chowmahalla Palace or Chowmahallat is the palace of the Nizams of Hyderabad State located in Hyderabad, Telangana, India.[1] It was the seat of power of the Asaf Jahi dynasty (1720-1948) and was the official residence of the Nizams during their reign. The palace has been converted into a museum and the ownership still lies with the family.[2][3]\r\n\r\nThe palace was constructed at the location of an earlier palace of the Qutb Shahi dynasty and Asaf Jahi dynasty[3] close to the Charminar. Construction of the palace, as it stands today, was started by Nizam Ali Khan Asaf Jah II[4] in 1769. He ordered the building of four palaces from which the nomenclature of Chau Mahalla is derived.[5] The word chÄr or chahÄr, and its variation chow, means \"four\" and the word mahal means \"palace\" in Urdu, Hindi and Persian.[6]\r\n\r\n\r\nClock tower at Chowmahalla Palace\r\n\r\nChowmahalla Palace\r\n\r\nChowmahalla Palace\r\nHistory\r\n\r\nPanoramic view in two parts of the Chowmahalla Palace at Hyderabad, photographed by Deen Dayal in the 1880s. The Charminar and Mecca Masjid are seen in the background (far right).\r\n\r\nSouthern courtyard and facade of Tehniyat Mahal\r\n\r\nDrawing room\r\nWhile Salabat Jung initiated its construction in 1750, the palace was completed by the period of Afzal ad-Dawlah, Asaf Jah V between 1857 and 1869.[7][8]\r\n\r\nThe palace is unique for its style and elegance. Construction began in the late 18th century and over the decades a synthesis of many architectural styles and influences emerged. The palace consists of two courtyards as well as the grand Khilwat (the Darbar Hall), fountains and gardens.[9] The palace originally covered 45 acres (180,000 m2), but only 12 acres (49,000 m2) remain today.\r\nSouthern courtyard\r\n\r\nInterior with chandeliers\r\n\r\nWatch tower gate\r\n\r\nOrnate with intricate stucco work, this is one of the two windows that flank the facade of the durbar hall.\r\nThis is the oldest part of the palace, consisting of four palaces: Afzal Mahal, Mahtab Mahal, Tahniyat Mahal and Aftab Maha, built symmetrically opposite each other in Neoclassical style. The forecourt between the palaces is adorned with a pond and a garden.[2][3]\r\n\r\nThe neoclassical palaces have double-height verandahs or faÃ§ades lined with European style columns. The columns in the Aftab Mahal and Mehtab Mahal are of Ionic order whereas the Afzal Mahal and Tehniyat Mahal have Corinthian columns.[3]\r\n\r\nNorthern courtyard\r\nThis part has Bara Imam, a long corridor of rooms on the east side facing the central fountain and pool that once housed the administrative wing; and Shishe-Alat, meaning mirror image.\r\n\r\nIt has Mughal domes and arches and many Persian elements such as the ornate stucco works that adorn the Khilwat Mubarak. These were characteristic of buildings built in Hyderabad at the time.\r\n\r\nOpposite the Bara Imam is a building that is its shishe or mirror image. The rooms were once used as guest rooms for officials accompanying visiting dignitaries.','','Travel','choumahala_palace.webp','hyderabad,india','2025-07-24 06:57:16','1970-01-01 05:30:00'),(10,'Hyderabadi Dum ka Murgh','hyderabadi dum ka murgh\r\nHyderabadi Dum ka Murgh (also known as Dum ka Chicken) is a traditional slow-cooked chicken dish from Hyderabadi cuisine. The chicken is marinated in yogurt and spices, then sealed in a pot and cooked on low heat, a method known as \'dum\' cooking, resulting in a rich and flavorful gravy. It is often served with naan or basmati rice. \r\nKey Ingredients\r\nChicken pieces\r\nYogurt\r\nFried onions\r\nGinger-garlic paste\r\nSpices such as turmeric, red chili powder, cumin powder, coriander powder, garam masala\r\nCashews (powdered or made into a paste)\r\nChironji (calumpang nuts)\r\nLemon juice\r\nFresh herbs like mint and cilantro \r\nPreparation\r\nMarination: A marinade is prepared by combining yogurt, fried onions, ginger-garlic paste, spices, cashew and chironji paste, lemon juice, salt, and fresh herbs. The chicken pieces are coated in this marinade and allowed to rest for several hours, ideally 2-4 hours.\r\nDum Cooking: After marination, the chicken is cooked in a heavy-bottomed pan. The pan is sealed tightly, often with dough, to trap the steam and flavors. The chicken is cooked over medium heat for approximately 35-40 minutes.\r\nResting: After cooking, the heat is turned off, but the seal is left intact for an additional 10 minutes to allow the flavors to further develop. \r\nThis slow cooking process ensures the chicken remains tender and absorbs the rich flavors of the marinade and spices, creating a delicious and aromatic curry. It is often garnished with coriander and cashew pieces before serving. ','','Recipes','IMG_9495.jpg','chicken','2025-07-24 07:21:32','1970-01-01 05:30:00'),(11,'Hyderabadi Marag','Hyderabadi Marag is a flavorful, thin, mutton soup/stew that originated in Hyderabad, India,\r\nHere\'s some information about Hyderabadi Marag:\r\nOrigin and History: Marag is a traditional Hyderabadi delicacy believed to have been influenced by Arabic cuisine, specifically a meat broth called Marag brought to Hyderabad by Yemeni migrants during the 1800s.\r\nIngredients: The key ingredients in Hyderabadi Marag typically include tender, bone-in mutton, onions, ginger-garlic paste, a blend of spices like cardamom, cinnamon, cloves, black pepper, and sometimes cashews, almonds, and coconut for a creamy base. Some recipes may also include yogurt or cream.\r\nPreparation: Traditionally, Marag is slow-cooked over a fire, but it can also be prepared in a deep pan or pressure cooker. The mutton is cooked until tender and succulent, and the flavors are allowed to meld.\r\nServing: Marag is typically served as a starter at Hyderabadi weddings and is often accompanied by Naan or Rumali roti.\r\nFlavor Profile: Hyderabadi Marag is characterized by its rich, aromatic flavor and a hint of spiciness. The inclusion of spices and nuts gives it a creamy texture and depth of flavor.\r\nRestaurants in Hyderabad: Several restaurants in Hyderabad are known for serving authentic Hyderabadi Marag. Some popular choices include Bawarchi, Hotel Shadab, Shah Ghouse, and others listed in the Zomato search results. Reviews suggest that Hotel Shadab and Shah Ghouse at Lakdikapul are highly recommended. ','','Recipes','E4vOykwUcAUTozT.jpg_large','hyderabadi','2025-07-24 07:31:28','1970-01-01 05:30:00');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--
-- WHERE:  1 LIMIT 10

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,1,'how can i get the high protines','2025-09-04 13:06:21'),(2,1,'What are the most important fruits which should use everyday in our life ? ','2025-09-08 09:04:48');
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_details` (
  `sno` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_details`
--
-- WHERE:  1 LIMIT 10

LOCK TABLES `user_details` WRITE;
/*!40000 ALTER TABLE `user_details` DISABLE KEYS */;
INSERT INTO `user_details` VALUES (1,'admin','adil123');
/*!40000 ALTER TABLE `user_details` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-21 14:41:15
