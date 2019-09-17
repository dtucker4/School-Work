#include "as8.h"
MTREE* createTree() {
	MTREE* tree;
	tree = (MTREE*)malloc(sizeof(MTREE));
	if (tree) {
		tree->count = 0;
		tree->root = NULL;
	}
	return tree;
}
