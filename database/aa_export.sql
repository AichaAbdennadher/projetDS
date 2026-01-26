-- SQL Export for Event Planner project
-- Database structure based on aa_ prefix

SET FOREIGN_KEY_CHECKS = 0;




-- Table: aa_events (10 total with images)
TRUNCATE TABLE `aa_events`;
INSERT INTO `aa_events` (`aa_id`, `aa_title`, `aa_description`, `aa_start_date`, `aa_end_date`, `aa_place`, `aa_price`, `aa_capacity`, `aa_is_free`, `aa_category_id`, `aa_created_by`, `aa_image`, `created_at`, `updated_at`) VALUES
(1, 'Tech Conference 2026', 'A large gathering of tech enthusiasts to discuss future trends.', '2026-05-15 09:00:00', '2026-05-17 18:00:00', 'Tunis, La Marsa', 150.00, 500, 0, 1, 1, 'https://picsum.photos/seed/event1/800/400', NOW(), NOW()),
(2, 'Laravel Deep Dive', 'Mastering Laravel internals and advanced patterns.', '2026-06-10 10:00:00', '2026-06-10 17:00:00', 'Sfax, Digital Center', 50.00, 30, 0, 2, 1, 'https://picsum.photos/seed/event2/800/400', NOW(), NOW()),
(3, 'Web Design Meetup', 'Showcasing the latest UI/UX trends and tools.', '2026-05-20 18:30:00', '2026-05-20 21:00:00', 'Online (Zoom)', 0.00, 100, 1, 3, 1, 'https://picsum.photos/seed/event3/800/400', NOW(), NOW()),
(4, 'Rock Summer Festival', 'The biggest outdoor music festival of the season.', '2026-07-25 15:00:00', '2026-07-26 23:00:00', 'Sousse, Port El Kantaoui', 80.00, 2000, 0, 4, 1, 'https://picsum.photos/seed/event4/800/400', NOW(), NOW()),
(5, 'AI Ethics Summit', 'Discussing the future of morality in artificial intelligence.', '2026-08-05 09:00:00', '2026-08-05 17:00:00', 'Hammamet, Convention Center', 120.00, 200, 0, 1, 1, 'https://picsum.photos/seed/event5/800/400', NOW(), NOW()),
(6, 'Python for Data Science', 'A hands-on workshop on NumPy, Pandas and Scikit-Learn.', '2026-09-12 10:00:00', '2026-09-13 16:00:00', 'Tunis, Workspace', 60.00, 25, 0, 2, 1, 'https://picsum.photos/seed/event6/800/400', NOW(), NOW()),
(7, 'DevOps Community Meetup', 'Docker, Kubernetes and CI/CD pipelines discussion.', '2026-05-28 19:00:00', '2026-05-28 21:30:00', 'Ariana, Tech Hub', 0.00, 50, 1, 3, 1, 'https://picsum.photos/seed/event7/800/400', NOW(), NOW()),
(8, 'Jazz Night Under the Stars', 'Enjoy smooth jazz in a beautiful outdoor setting.', '2026-06-20 20:00:00', '2026-06-20 23:59:00', 'Carthage Park', 45.00, 300, 0, 4, 1, 'https://picsum.photos/seed/event8/800/400', NOW(), NOW()),
(9, 'Cloud Computing Day', 'Exploring AWS, Azure and GCP latest features.', '2026-10-15 08:30:00', '2026-10-15 17:30:00', 'Tunis, Hotel Africa', 200.00, 150, 0, 1, 1, 'https://picsum.photos/seed/event9/800/400', NOW(), NOW()),
(10, 'Cybersecurity Essentials', 'Learn how to protect your infrastructure from modern threats.', '2026-11-05 14:00:00', '2026-11-05 18:00:00', 'Online', 30.00, 100, 0, 2, 1, 'https://picsum.photos/seed/event10/800/400', NOW(), NOW());

-- Table: aa_registrations (6 total)
TRUNCATE TABLE `aa_registrations`;
INSERT INTO `aa_registrations` (`aa_id`, `aa_user_id`, `aa_event_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NOW(), NOW()),
(2, 2, 2, NOW(), NOW()),
(3, 2, 4, NOW(), NOW()),
(4, 2, 10, NOW(), NOW()),
(5, 1, 1, NOW(), NOW()),
(6, 1, 5, NOW(), NOW());

SET FOREIGN_KEY_CHECKS = 1;
