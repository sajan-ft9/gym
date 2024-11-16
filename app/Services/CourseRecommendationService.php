<?php
namespace App\Services;

use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class CourseRecommendationService
{
    /**
     * Get recommended courses for the logged-in user using collaborative filtering
     *
     * @param User $user
     * @return Collection
     */
    public function recommendCourses(User $user)
    {
        // Step 1: Get the features for the logged-in user
        $loggedInUserFeatures = $this->getUserFeatures($user);

        // Step 2: Calculate similarity for all users
        $similarities = $this->calculateUserSimilarities($user, $loggedInUserFeatures);

        // Step 3: Find the top N most similar users
        $mostSimilarUsers = $this->getMostSimilarUsers($similarities);

        // Step 4: Get the courses that these similar users are enrolled in
        $recommendedCourses = $this->getRecommendedCourses($mostSimilarUsers);

        return $recommendedCourses;
    }

    /**
     * Get the feature vector for a user (gender, education, age, district)
     *
     * @param User $user
     * @return array
     */
    private function getUserFeatures(User $user)
    {
        // Normalize user features, for example, age can be numeric, and gender, district, education could be categorical
        return [
            'gender' => $user->gender, // This could be 1 for male, 0 for female, or encoded as categories
            'education' => $user->education, // You may want to convert education to a numerical scale
            'district' => $user->district, // Similarly, encode district as categories
            'age' => $user->age // Age is a continuous value, so you may normalize it (min-max or z-score normalization)
        ];
    }

    /**
     * Calculate the similarity of the logged-in user to all other users
     *
     * @param User $user
     * @param array $loggedInUserFeatures
     * @return array
     */
    private function calculateUserSimilarities(User $user, array $loggedInUserFeatures)
    {
        $allUsers = User::where('id', '!=', $user->id)->get();
        $similarities = [];

        foreach ($allUsers as $otherUser) {
            $otherUserFeatures = $this->getUserFeatures($otherUser);
            $similarity = $this->euclideanDistance($loggedInUserFeatures, $otherUserFeatures);
            $similarities[$otherUser->id] = $similarity;
        }

        // Sort users by similarity score (higher is better)
        asort($similarities);
        return $similarities;
    }

    /**
     * Calculate Euclidean distance between two feature vectors
     *
     * @param array $user1
     * @param array $user2
     * @return float
     */
    private function euclideanDistance(array $user1, array $user2)
    {
        $sum = 0;
        foreach ($user1 as $key => $value) {
            // Assume both users have the same keys
            $sum += pow($user1[$key] - $user2[$key], 2);
        }

        return sqrt($sum);
    }

    /**
     * Get the most similar users based on similarity scores
     *
     * @param array $similarities
     * @param int $limit
     * @return Collection
     */
    private function getMostSimilarUsers(array $similarities, $limit = 5)
    {
        // Get the top N most similar users
        $topSimilarUsers = array_slice($similarities, 0, $limit, true);

        return User::whereIn('id', array_keys($topSimilarUsers))->get();
    }

    /**
     * Get the recommended courses based on what similar users are enrolled in
     *
     * @param Collection $mostSimilarUsers
     * @return Collection
     */
    private function getRecommendedCourses(Collection $mostSimilarUsers)
    {
        $recommendedCourseIds = [];

        foreach ($mostSimilarUsers as $user) {
            $enrolledCourses = $user->courses;

            foreach ($enrolledCourses as $course) {
                if (!in_array($course->id, $recommendedCourseIds)) {
                    $recommendedCourseIds[] = $course->id;
                }
            }
        }

        return Course::whereIn('id', $recommendedCourseIds)->get();
    }
}
